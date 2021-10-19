<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\File
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $file
 * @property string|null $extension
 * @property string|null $mime
 * @property string|null $url
 * @property int|null $fileable_id
 * @property string|null $fileable_type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Model|\Eloquent $fileable
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static \Illuminate\Database\Query\Builder|File onlyTrashed()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereDeletedAt($value)
 * @method static Builder|File whereExtension($value)
 * @method static Builder|File whereFile($value)
 * @method static Builder|File whereFileableId($value)
 * @method static Builder|File whereFileableType($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereMime($value)
 * @method static Builder|File whereName($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @method static Builder|File whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|File withTrashed()
 * @method static \Illuminate\Database\Query\Builder|File withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|File whereType($value)
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $setting_group_id
 * @property string $name
 * @property string|null $code
 * @property string $value
 * @property int|null $rich_text
 * @property-read \App\Models\SettingGroup|null $settingGroup
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting settingGroupByName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRichText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSettingGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SettingGroup
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Setting[] $settings
 * @property-read int|null $settings_count
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup settingsByName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereUpdatedAt($value)
 */
	class SettingGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property int|null $syst_position_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CounMeetingCitation[] $counMeetingCitations
 * @property-read int|null $coun_meeting_citations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CounMember[] $counMembers
 * @property-read int|null $coun_members_count
 * @property-read \App\Models\SystPosition|null $systPosition
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserProfile[] $userProfiles
 * @property-read int|null $user_profiles_count
 * @method static Builder|User counMeetingCitationsByName($name)
 * @method static Builder|User counMembersByName($name)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User systPositionByName($name)
 * @method static Builder|User userProfilesByName($name)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSystPositionId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $accept_terms_conditions
 * @property string|null $first_name
 * @property string|null $last_name
 * @method static Builder|User whereAcceptTermsConditions($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereLastName($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $userRoles
 * @property-read int|null $user_roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User userRolesByName($name)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserPermission
 *
 * @property int $id
 * @property int|null $user_permission_group_id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $userRoles
 * @property-read int|null $user_roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission userRolesByName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereUserPermissionGroupId($value)
 */
	class UserPermission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int|null $user_id
 * @property int|null $syst_city_id
 * @property int|null $syst_region_id
 * @property int|null $syst_country_id
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static Builder|UserProfile newModelQuery()
 * @method static Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserProfile onlyTrashed()
 * @method static Builder|UserProfile query()
 * @method static Builder|UserProfile systCityByName($name)
 * @method static Builder|UserProfile systCountryByName($name)
 * @method static Builder|UserProfile systRegionByName($name)
 * @method static Builder|UserProfile userByName($name)
 * @method static Builder|UserProfile whereAddress($value)
 * @method static Builder|UserProfile whereAvatar($value)
 * @method static Builder|UserProfile whereCreatedAt($value)
 * @method static Builder|UserProfile whereDeletedAt($value)
 * @method static Builder|UserProfile whereId($value)
 * @method static Builder|UserProfile whereName($value)
 * @method static Builder|UserProfile wherePhone($value)
 * @method static Builder|UserProfile whereSystCityId($value)
 * @method static Builder|UserProfile whereSystCountryId($value)
 * @method static Builder|UserProfile whereSystRegionId($value)
 * @method static Builder|UserProfile whereUpdatedAt($value)
 * @method static Builder|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserProfile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserProfile withoutTrashed()
 * @mixin \Eloquent
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserPermission[] $userPermissions
 * @property-read int|null $user_permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole userPermissionsByName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole usersByName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUpdatedAt($value)
 */
	class UserRole extends \Eloquent {}
}

namespace App{
/**
 * App\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereToken($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PasswordReset whereUpdatedAt($value)
 */
	class PasswordReset extends \Eloquent {}
}

namespace App{
/**
 * App\Setting
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $setting_group_id
 * @property string $name
 * @property string|null $code
 * @property string $value
 * @property int|null $rich_text
 * @property-read \App\SettingGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRichText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSettingGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 * @property-read \App\SettingGroup|null $settingGroup
 */
	class Setting extends \Eloquent {}
}

namespace App{
/**
 * App\SettingGroup
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|SettingGroup[] $settings
 * @property-read int|null $settings_count
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SettingGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class SettingGroup extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $syst_position_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSystPositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $accept_terms_conditions
 * @property string|null $first_name
 * @property string|null $last_name
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAcceptTermsConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserRole[] $roles
 * @property-read int|null $roles_count
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject, \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App{
/**
 * App\UserPermission
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $user_permission_group_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserRole[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereUserPermissionGroupId($value)
 */
	class UserPermission extends \Eloquent {}
}

namespace App{
/**
 * App\UserRole
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserPermission[] $permissions
 * @property-read int|null $permissions_count
 */
	class UserRole extends \Eloquent {}
}

