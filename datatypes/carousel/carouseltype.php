<?php

/**
 * File containing Carousel datatype definition
 * @licence http://www.gnu.org/licenses/gpl-2.0.txt GNU GPLv2
 * @version @@@VERSION@@@
 */
class CarouselType extends eZDataType
{

    const DATA_TYPE_STRING = 'carousel';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::eZDataType( self::DATA_TYPE_STRING, 'Carousel' );

    }

    public function validateClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        // TODO : Validate SearchIndex and BrowseNode validity
        return eZInputValidator::STATE_ACCEPTED;

    }

    public function fixupClassAttributeHTTPInput( $http, $base, $classAttribute )
    {
        
    }

    function objectAttributeContent( $contentObjectAttribute )
    {

        return $contentObjectAttribute->attribute( 'data_text' );

    }

    public function initializeObjectAttribute( $contentObjectAttribute, $currentVersion, $originalContentObjectAttribute )
    {


        $contentObjectAttribute->setAttribute( 'data_text', 'default content' );

    }

    public function customObjectAttributeHTTPAction( $http, $action, $contentObjectAttribute, $parameters )
    {
        if ( $action == 'browse_images' )
        {
            $browseParameters = array( 'action_name' => 'AddRelatedObject_' . $contentObjectAttribute->attribute( 'id' ),
                'type' => $browseType,
                'browse_custom_action' => array( 'name' => 'CustomActionButton[' . $contentObjectAttribute->attribute( 'id' ) . '_set_object_relation_list]',
                    'value' => $contentObjectAttribute->attribute( 'id' ) ),
                'persistent_data' => array( 'HasObjectInput' => 0 ),
                'from_page' => $redirectionURI );
            $base = $parameters['base_name'];
            $nodePlacementName = $base . '_browse_for_object_start_node';
            if ( $http->hasPostVariable( $nodePlacementName ) )
            {
                $nodePlacement = $http->postVariable( $nodePlacementName );
                if ( isset( $nodePlacement[$contentObjectAttribute->attribute( 'id' )] ) )
                    $browseParameters['start_node'] = eZContentBrowse::nodeAliasID( $nodePlacement[$contentObjectAttribute->attribute( 'id' )] );
            }
            if ( count( $classConstraintList ) > 0 )
                $browseParameters['class_array'] = $classConstraintList;

            eZContentBrowse::browse( $browseParameters, $module );
        }

    }

}

eZDataType::register( CarouselType::DATA_TYPE_STRING, 'CarouselType' );