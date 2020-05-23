<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/automl/v1beta1/data_stats.proto

namespace Google\Cloud\AutoMl\V1beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The data statistics of a series of STRUCT values.
 *
 * Generated from protobuf message <code>google.cloud.automl.v1beta1.StructStats</code>
 */
class StructStats extends \Google\Protobuf\Internal\Message
{
    /**
     * Map from a field name of the struct to data stats aggregated over series
     * of all data in that field across all the structs.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.automl.v1beta1.DataStats> field_stats = 1;</code>
     */
    private $field_stats;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array|\Google\Protobuf\Internal\MapField $field_stats
     *           Map from a field name of the struct to data stats aggregated over series
     *           of all data in that field across all the structs.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Automl\V1Beta1\DataStats::initOnce();
        parent::__construct($data);
    }

    /**
     * Map from a field name of the struct to data stats aggregated over series
     * of all data in that field across all the structs.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.automl.v1beta1.DataStats> field_stats = 1;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getFieldStats()
    {
        return $this->field_stats;
    }

    /**
     * Map from a field name of the struct to data stats aggregated over series
     * of all data in that field across all the structs.
     *
     * Generated from protobuf field <code>map<string, .google.cloud.automl.v1beta1.DataStats> field_stats = 1;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setFieldStats($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\AutoMl\V1beta1\DataStats::class);
        $this->field_stats = $arr;

        return $this;
    }

}

