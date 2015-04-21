<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/19/15
 * Time: 1:05 PM
 */

namespace libs;


class Query {
    const SELECT_ALL = "SELECT * FROM #table_names";
    const CONDITIONAL_SELECT_ALL = "SELECT * FROM #table_names WHERE @condition";
    const SELECT_FIELDS = "SELECT @fields FROM #table_names";
    const CONDITIONAL_SELECT_FIELDS = "SELECT @fields FROM #table_names WHERE @condition";

    const UPDATE = "UPDATE #table_name SET @field=:updated_value WHERE @condition";
    const UPDATE_TIME = "UPDATE #table_name SET @field=NOW() WHERE @condition";
}

class Circles extends Query{

    const CREATE = "INSERT INTO circles (circle_name, created_at, modified_at, active_status)
                    VALUE (:circle_name, NOW(), NOW())";
}

class EmergencyTypes extends Query{
    const CREATE = "INSERT INTO emergency_types (emergency_name, emergency_description, created_at, modified_at)
                    VALUE (:type_name, :description, NOW(), NOW())";
}

class ImageCategories extends Query{
    const CREATE = "INSERT INTO image_categories (image_category_name, created_at, modified_at)
                    VALUE (:category_name, NOW(), NOW())";
}

class Images extends Query{
    const CREATE = "INSERT INTO images (alt_text, category_id, url, created_at, modified_at)
                    VALUE (:alt_text, :category_id, :url, NOW(), NOW())";

    const IMAGE_DETAILS = "SELECT alt_text, image_category_name, image_url
                                FROM images, image_categories
                                WHERE image_category_id=category_id";
}

class Institutes extends Query{
    const CREATE = "INSERT INTO institutes (institute_name, base_location_id, created_at, modified_at)
                    VALUE (:institute_name, :base_location_id, NOW(), NOW())";

    const INSTITUTE_DETAILS = "SELECT institute_name, locations.latitude, locations.longitude, subscriptions.emergency_type_id
                               FROM institutes, locations, subscriptions
                               WHERE base_location_id=location_id
                               AND subscriptions.institute_id=institutes.institute_id";

    const SPECIFIC_INSTITUTE_DETAILS = "SELECT institute_name, locations.latitude, locations.longitude
                                        FROM institutes, locations
                                        WHERE base_location_id=location_id
                                        AND institutes.institute_id=:institute_id";
}

class Locations extends Query{
    const CREATE = "INSERT INTO locations (latitude, longitude, place_id, address, created_at, modified_at)
                    VALUE (:latitude, :longitude, :place_id, :address, NOW(), NOW())";

}

class Permissions extends Query{
    const CREATE = "INSERT INTO permissions (permission_name, permission_description, created_at, modified_at)
                    VALUE (:perm_name, :description, NOW(), NOW())";
}

class Reports extends Query{
    const CREATE = "INSERT INTO reports (emergency_type_id, location_id, extra_description, emergency_status_id, created_at, modified_at, active_status)
                    VALUE (:emergency_type_id, :location_id, :extra_description, :emergency_status_id, NOW(), NOW(), 1)";

    const NOTIFICATIONS = "SELECT reports.report_id, reports.emergency_status_id, emergency_name, emergency_description, emergency_status.emergency_status_name, locations.latitude,
                            locations.longitude, locations.place_id, locations.address, user_notifications.user_response_type_id,
                            reports.extra_description, institutes.institute_name
                            FROM emergency_types, emergency_status, locations, reports, institutes, user_institutes, subscriptions, user_notifications
                            WHERE reports.emergency_type_id=emergency_types.emergency_type_id
                            AND reports.report_id=user_notifications.report_id
                            AND reports.emergency_status_id=emergency_status.emergency_status_id
                            AND reports.location_id=locations.location_id
                            AND user_institutes.user_id=:user_id
                            AND institutes.institute_id=user_institutes.institute_id
                            AND subscriptions.institute_id=institutes.institute_id
                            AND subscriptions.emergency_type_id=reports.emergency_type_id
                            AND reports.report_id NOT IN (SELECT report_id FROM user_notifications WHERE user_id=:user_id AND user_response_type_id IN(:response_id))
                            ORDER BY reports.modified_at DESC";


    const UNREAD_NOTES = "SELECT reports.report_id, reports.emergency_status_id, emergency_name, emergency_description, emergency_status.emergency_status_name, locations.latitude,
                            locations.longitude, locations.place_id, locations.address,
                            reports.extra_description, institutes.institute_name
                            FROM emergency_types, emergency_status, locations, reports, institutes, user_institutes, subscriptions
                            WHERE reports.emergency_type_id=emergency_types.emergency_type_id
                            AND reports.emergency_status_id=emergency_status.emergency_status_id
                            AND reports.location_id=locations.location_id
                            AND user_institutes.user_id=:user_id
                            AND institutes.institute_id=user_institutes.institute_id
                            AND subscriptions.institute_id=institutes.institute_id
                            AND subscriptions.emergency_type_id=reports.emergency_type_id
                            AND reports.report_id NOT IN (SELECT report_id FROM user_notifications WHERE user_id=:user_id AND user_response_type_id IN(1,2,3,4))";

    const LATEST_NOTES = "SELECT reports.report_id, reports.emergency_status_id, emergency_name, emergency_description, emergency_status.emergency_status_name, locations.latitude,
                            locations.longitude, locations.place_id, locations.address,
                            reports.extra_description, institutes.institute_name
                            FROM emergency_types, emergency_status, locations, reports, institutes, user_institutes, subscriptions
                            WHERE reports.emergency_type_id=emergency_types.emergency_type_id
                            AND reports.emergency_status_id=emergency_status.emergency_status_id
                            AND reports.location_id=locations.location_id
                            AND user_institutes.user_id=:user_id
                            AND institutes.institute_id=user_institutes.institute_id
                            AND subscriptions.institute_id=institutes.institute_id
                            AND subscriptions.emergency_type_id=reports.emergency_type_id
                            AND reports.report_id NOT IN (SELECT report_id FROM user_notifications WHERE user_id=:user_id AND user_response_type_id IN(1,2,3))
                            AND NOW()-reports.modified_at<:poll_interval
                            ORDER BY reports.modified_at DESC";


    const REPORT_DETAILS = "SELECT reports.report_id, locations.latitude, locations.longitude,
                            emergency_name, locations.place_id
                            FROM reports, locations, emergency_types
                            WHERE reports.location_id=locations.location_id
                            AND reports.emergency_type_id=emergency_types.emergency_type_id";


}

class RolePermissions extends Query{
    const CREATE = "INSERT INTO role_permissions (role_id, permission_id, created_at, modified_at)
                    VALUE (:role_id, :permission_id, NOW(), NOW())";

    const ROLE_PERMISSION_DETAILS = "SELECT role_name, role_description, permission_name, permission_description
                             FROM roles, permissions, role_permissions
                             WHERE role_permissions.role_id=roles.role_id
                             AND role_permissions.permission_id=permissions.permission_id";

    const ROLE_PERMISSION_DETAILS_SPECIFIC = "SELECT role_name, role_description, permission_name, permission_description
                                              FROM roles, permissions, role_permissions
                                              WHERE roles.role_id=:role_id
                                              AND role_permissions.permission_id=permissions.permission_id";
}

class Roles extends Query{
    const CREATE = "INSERT INTO roles (role_name, role_description, created_at, modified_at)
                    VALUE (:role_name, :description, NOW(), NOW())";

}

class Subscriptions extends Query{
    const CREATE = "INSERT INTO subscriptions (institute_id, emergency_type_id, created_at, modified_at)
                    VALUE (:institute_id, :type_id, NOW(), NOW())";

    const SUBSCRIPTION_DETAILS = "SELECT emergency_types.emergency_name, emergency_types.emergency_description
                                  FROM subscriptions, emergency_types
                                  WHERE emergency_types.emergency_type_id=subscriptions.emergency_type_id
                                  AND subscriptions.institute_id=:institute_id";
}

class UserCircles extends Query{
    const CREATE = "INSERT INTO user_circles (user_id, circle_id, member_id, created_at, modified_at)
                    VALUE (:user_id, :circle_id, :member_id, NOW(), NOW())";
}

class UserInstitutes extends Query{
    const CREATE = "INSERT INTO user_institutes (user_id, institute_id, created_at, modified_at)
                    VALUE (:user_id, :institute_id, NOW(), NOW())";

    const MY_INSTITUTES_COLLEAGUES = "SELECT users.username, users.email, roles.role_name
                                      FROM users, roles, user_institutes
                                      WHERE users.user_id=user_institutes.user_id
                                      AND roles.role_id=users.role_id
                                      AND user_institutes.institute_id=:institute_id
                                      AND users.user_id!=:user_id";
    const OTHER_INSTITUTES_MEMBERS = "";
}

class UserNotifications extends Query{
    const CREATE =  "INSERT INTO user_notifications (user_id, report_id, emergency_status_id, user_response_type_id, created_at, modified_at)
                     VALUE (:user_id, :report_id, :emergency_status_id, :user_response_type_id, NOW(), NOW())";
}
class Users extends Query{
    const CREATE = "INSERT INTO users (username, email, password, role_id, profile_img_id, created_at, modified_at)
                    VALUE (:username, :email, :password, :role_id, profile_img_id, NOW(), NOW())";

    const USER_ROLE = "SELECT users.user_id, users.username, users.email, users.password,  ";
}

class Messages extends Query{

    const CREATE = "INSERT INTO messages (title, sender_name, sender_phone_num, sender_email, body, created_at, modified_at)
                    VALUE (:title, :sender_email, :sender_phone_num, :sender_email, :body, NOW(), NOW())";

}