<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/bigtable/admin/v2/bigtable_instance_admin.proto

namespace Google\Cloud\Bigtable\Admin\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Request message for BigtableInstanceAdmin.UpdateAppProfile.
 *
 * Generated from protobuf message <code>google.bigtable.admin.v2.UpdateAppProfileRequest</code>
 */
class UpdateAppProfileRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Required. The app profile which will (partially) replace the current value.
     *
     * Generated from protobuf field <code>.google.bigtable.admin.v2.AppProfile app_profile = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $app_profile = null;
    /**
     * Required. The subset of app profile fields which should be replaced.
     * If unset, all fields will be replaced.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     */
    private $update_mask = null;
    /**
     * If true, ignore safety checks when updating the app profile.
     *
     * Generated from protobuf field <code>bool ignore_warnings = 3;</code>
     */
    private $ignore_warnings = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\Bigtable\Admin\V2\AppProfile $app_profile
     *           Required. The app profile which will (partially) replace the current value.
     *     @type \Google\Protobuf\FieldMask $update_mask
     *           Required. The subset of app profile fields which should be replaced.
     *           If unset, all fields will be replaced.
     *     @type bool $ignore_warnings
     *           If true, ignore safety checks when updating the app profile.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Bigtable\Admin\V2\BigtableInstanceAdmin::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The app profile which will (partially) replace the current value.
     *
     * Generated from protobuf field <code>.google.bigtable.admin.v2.AppProfile app_profile = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\Bigtable\Admin\V2\AppProfile
     */
    public function getAppProfile()
    {
        return $this->app_profile;
    }

    /**
     * Required. The app profile which will (partially) replace the current value.
     *
     * Generated from protobuf field <code>.google.bigtable.admin.v2.AppProfile app_profile = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\Bigtable\Admin\V2\AppProfile $var
     * @return $this
     */
    public function setAppProfile($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Bigtable\Admin\V2\AppProfile::class);
        $this->app_profile = $var;

        return $this;
    }

    /**
     * Required. The subset of app profile fields which should be replaced.
     * If unset, all fields will be replaced.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Protobuf\FieldMask
     */
    public function getUpdateMask()
    {
        return $this->update_mask;
    }

    /**
     * Required. The subset of app profile fields which should be replaced.
     * If unset, all fields will be replaced.
     *
     * Generated from protobuf field <code>.google.protobuf.FieldMask update_mask = 2 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Protobuf\FieldMask $var
     * @return $this
     */
    public function setUpdateMask($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\FieldMask::class);
        $this->update_mask = $var;

        return $this;
    }

    /**
     * If true, ignore safety checks when updating the app profile.
     *
     * Generated from protobuf field <code>bool ignore_warnings = 3;</code>
     * @return bool
     */
    public function getIgnoreWarnings()
    {
        return $this->ignore_warnings;
    }

    /**
     * If true, ignore safety checks when updating the app profile.
     *
     * Generated from protobuf field <code>bool ignore_warnings = 3;</code>
     * @param bool $var
     * @return $this
     */
    public function setIgnoreWarnings($var)
    {
        GPBUtil::checkBool($var);
        $this->ignore_warnings = $var;

        return $this;
    }

}

