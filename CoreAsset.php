<?php

namespace alexeikadev\yii2FullcalendarAndScheduler;

/**
 * Class CoreAsset
 * @package edofre\fullcalendar
 */
class CoreAsset extends \yii\web\AssetBundle
{
    /**
     * @var  boolean
     * Whether to automatically generate the needed language js files.
     * If this is true, the language js files will be determined based on the actual usage of [[DatePicker]]
     * and its language settings. If this is false, you should explicitly specify the language js files via [[js]].
     */
    public $autoGenerate = true;
    /** @var  array Required CSS files for the fullcalendar */
    public $css = [
        'fullcalendar/main.css',
        'fullcalendar-scheduller/main.css',
    ];
    /** @var  array List of the dependencies this assets bundle requires */
    public $depends = [
        'yii\web\YiiAsset',
    ];
    /**
     * @var  boolean
     * FullCalendar can display events from a public Google Calendar. Google Calendar can serve as a backend that manages and persistently stores event data (a feature that FullCalendar currently lacks).
     * Please read http://fullcalendar.io/docs/google_calendar/ for more information
     */
    public $googleCalendar = false;
    /** @var  array Required JS files for the fullcalendar */
    public $js = [
        'fullcalendar/main.js',
        'fullcalendar/locale-all.js',

        'fullcalendar-scheduller/main.js',
        'fullcalendar-scheduller/locale-all.js',
    ];
    /** @var  string Language for the fullcalendar */
    public $language = null;
    /** @var  string Location of the fullcalendar distribution */
    public $sourcePath = '@vendor/alexeikadev/yii2-fullcalendar-and-scheduler/dist';

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        $language = empty($this->language) ? \Yii::$app->language : $this->language;
        if (file_exists($this->sourcePath . "fullcalendar/locale/$language.js")) {
            $this->js[] = "fullcalendar/locales/$language.js";
        }
        if (file_exists($this->sourcePath . "fullcalendar-scheduller/locale/$language.js")) {
            $this->js[] = "fullcalendar-scheduller/locales/$language.js";
        }


        // We need to return the parent implementation otherwise the scripts are not loaded
        return parent::registerAssetFiles($view);
    }
}
