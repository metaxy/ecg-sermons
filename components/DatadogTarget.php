<?php
namespace app\components;
use Yii;

use yii\log\Logger;
use yii\log\Target;

/**
 * Datadog Log Target
 * Send errors and warnings count to Datadog
 *
 * Class DatadogTarget
 * @package app\components
 */
class DatadogTarget extends Target
{

    /**
     * Defaults levels to log
     * @var array
     */
    public $levels = ['error'];
    /**
     * Prefix for metric name (required)
     * @var string
     */
    public $metricPrefix;

    /**
     * Tags, merged with message category (optional)
     * @var array
     */
    public $tags = [];
    public $apiKey = "";
    public $appKey = "";
    public function init()
    {
        parent::init();
        \Datadogstatsd::configure($this->apiKey, $this->appKey);

    }
    /**
     * Ignored categories. Defaults to ['yii\web\HttpException:404']
     * @var array
     */
    public $ignoredCategories = ['yii\web\HttpException:404'];

    /**
     * {@inheritdoc}
     */
    public function export()
    {

        foreach ($this->messages as $message) {
            if (in_array($message[2], $this->ignoredCategories, true)) {
                continue;
            }
            if (!in_array(Logger::getLevelName($message[1]), $this->levels, true)) {
                continue;
            }
            $level = $message[1];
            $alertType = "success";
            if($level === Logger::LEVEL_ERROR) {
                $alertType = "error";
            } else if($level === Logger::LEVEL_WARNING) {
                $alertType = "warning";
            } else if($level === Logger::LEVEL_INFO) {
                $alertType = "info";
            }

            $text = "# " . $message[0]."\n\n";
            if(count($message[4]) > 0) {
                $more = $message[4];
                print_r($more);
                foreach($more as $m) {
                    if (isset($m['file'])) {
                        $text .= $m['file'] . ":" . $m['line']."\n\n";
                    }
                    if (isset($m['trace'])) {
                        $text .= "```\n";
                        $text .= implode("\n", $m['trace']);
                        $text .= "```\n";
                    }
                }

            }

            \Datadogstatsd::event("Error", [
                'text'       => $text,
                'alert_type' => $alertType,
                'tags' => array_merge($this->tags, [$message[2]])
            ]);
        }
    }
}
