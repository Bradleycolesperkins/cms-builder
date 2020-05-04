<?php
namespace modules;

use Craft;
use craft\elements\Asset;
use craft\events\AssetEvent;
use yii\base\Event;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('my-module')`.
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['my-module']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 */
class TimeStampAssets extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
        parent::init();

        // Custom initialization code goes here...

        Event::on(
            \craft\services\Elements::class,
            \craft\services\Elements::EVENT_AFTER_SAVE_ELEMENT,
            function(Event $event)   {
                $asset = $event->element;
                try {
                    if ($event->isNew && $asset instanceof craft\elements\Asset) {
                        $folderId = $asset->getFolder();

                        $newName =  time() . '_' . $asset->getFilename(true);
                        Craft::$app->assets->moveAsset($asset, $folderId, $newName);
                    }
                } catch (\Exception $e){

                }
            }
        );
    }
}
