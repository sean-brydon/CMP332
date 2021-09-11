<?php


class Helpers
{
    public function isValidDate($date, $format = 'Y-m-d')
    {
        return DateTime::createFromFormat($format, $date);
    }
   
    
    public function arrayToXML($array) { 
        $xml = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $xml .= "<$key>";
                $xml .= $this->arrayToXML($value);
                $xml .= "</$key>";
            } else {
                $xml .= "<$key>$value</$key>";
            }
        }
        return $xml;
    } 
    // function from xml to array
    public function xmlToArray($xml) {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parse_into_struct($parser, $xml, $values, $index);
        xml_parser_free($parser);
        return $this->arrayToArray($values);
    }
    
    // function to convert xml to array
    private function arrayToArray($values) {
        $array = array();
        foreach ($values as $val) {
            if (isset($val['attributes'])) {
                $array[$val['tag']]['@' . $val['attributes']['key']] = $val['value'];
            } else {
                $array[$val['tag']] = $val['value'];
            }
            if (isset($val['children'])) {
                $array[$val['tag']]['children'] = $this->arrayToArray($val['children']);
            }
        }
        return $array;
    }
}
?>

}
