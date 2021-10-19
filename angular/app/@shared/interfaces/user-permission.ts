import {UserRole} from "@shared/interfaces/user-role";

export interface UserPermission {
  "id"?: any;
  "user_permission_group_id"?: any;
  "name"?: any;
  "code"?: any;
  "created_at"?: any;
  "updated_at"?: any;
  "user_roles"?: UserRole[] | null;
  "user_role_ids"?: any[] | null;
}
