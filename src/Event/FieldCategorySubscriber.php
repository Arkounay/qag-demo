<?php


namespace App\Event;

use App\Entity\Category;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Model\Field;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class FieldCategorySubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            'qag.events.field_generation' => 'fieldGenerationEvent'
        ];
    }

    public function fieldGenerationEvent(GenericEvent $event): void
    {
        /** @var Field $field */
        $field = $event->getSubject();

        if ($field->getAssociationMapping() === Category::class) {
            $field->setTwig('@ArkounayQuickAdminGenerator/crud/fields/_category.html.twig');
        }
    }

    private static function IsImages(Field $field): bool
    {
        return (stripos($field->getIndex(), 'images') !== false || stripos($field->getIndex(), 'gallery') !== false) && $field->getType() === 'simple_array';
    }


}