<?php

namespace alexeikadev\yii2FullcalendarAndScheduler;

/**
 * Class Fullcalendar
 * @package alexeikadev\yii2FullcalendarAndScheduler
 */
class FullcalendarAndScheduler extends \yii\base\Widget
{
	/**
	 * @var array  The fullcalendar options, for all available options check http://fullcalendar.io/docs/
	 */
	public $clientOptions = [
		'weekends' => true,
		'default'  => 'agendaDay',
		'editable' => false,
	];
	/**
	 * @var array  Array containing the events, can be JSON array, PHP array or URL that returns an array containing JSON events
	 */
	public $events = [];
	/** @var boolean  Determines whether or not to include the gcal.js */
	public $googleCalendar = false;
	/**
	 * @var array
	 * Possible header keys
	 * - center
	 * - left
	 * - right
	 * Possible options:
	 * - title
	 * - prevYear
	 * - nextYear
	 * - prev
	 * - next
	 * - today
	 * - basicDay
	 * - agendaDay
	 * - basicWeek
	 * - agendaWeek
	 * - month
	 */
	public $header = [
		'center' => 'title',
		'left'   => 'prev,next, today',
		'right'  => 'resourceTimelineDay,timeGridWeek,dayGridMonth',
	];
	/** @var string  Text to display while the calendar is loading */
	public $loading = 'Please wait, calendar is loading';
	/**
	 * @var array  Default options for the id and class HTML attributes
	 */
	public $options = [
		'id'    => 'calendar',
		'class' => 'fullcalendar',
        'initialDate'=>'2020-09-07',
        'editable'=>true,
         'selectable'=>true,
         'nowIndicator'=>true,
         'aspectRatio'=>1.8,
         'scrollTime'=>'00:00',
        'schedulerLicenseKey'=> 'CC-Attribution-NonCommercial-NoDerivatives',
	];
	/**
	 * @var boolean  Whether or not we need to include the ThemeAsset bundle
	 */
	public $theme = false;

	/**
	 * Always make sure we have a valid id and class for the Fullcalendar widget
	 */
	public function init()
	{
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
		if (!isset($this->options['class'])) {
			$this->options['class'] = 'fullcalendar';
		}

		parent::init();
	}

	/**
	 * Load the options and start the widget
	 */
	public function run()
	{
		$this->echoLoadingTags();

		$assets = CoreAsset::register($this->view);


		if (isset($this->options['language'])) {
			$assets->language = $this->options['language'];
		}

		$assets->googleCalendar = $this->googleCalendar;
		$this->clientOptions['headerToolbar'] = $this->header;

		$this->view->registerJs("
			
			    var calendarEl = document.getElementById('{$this->options['id']}');
			    var calendar = new FullCalendar.Calendar(calendarEl, {$this->getClientOptions()});
			    calendar.render();
			", \yii\web\View::POS_READY);
	}

	/**
	 * Echo the tags to show the loading state for the calendar
	 */
	private function echoLoadingTags()
	{
		echo \yii\helpers\Html::beginTag('div', $this->options) . "\n";
		echo \yii\helpers\Html::beginTag('div', ['class' => 'fc-loading', 'style' => 'display:none;']);
		echo \yii\helpers\Html::encode($this->loading);
		echo \yii\helpers\Html::endTag('div') . "\n";
		echo \yii\helpers\Html::endTag('div') . "\n";
	}

	/**
	 * @return string
	 * Returns an JSON array containing the fullcalendar options,
	 * all available callbacks will be wrapped in JsExpressions objects if they're set
	 */
	private function getClientOptions()
	{
		$options['loading'] = new \yii\web\JsExpression("function(isLoading, view ) {
			jQuery('#{$this->options['id']}').find('.fc-loading').toggle(isLoading);
        }");

		$options['events'] = $this->events;
		$options = array_merge($options, $this->clientOptions);

		return \yii\helpers\Json::encode($options);
	}
}
