import {UserPermission} from "@shared/interfaces/user-permission";
import {User} from "@shared/interfaces/user";

export interface UserRole {
  id?: any;
  name?: any;
  code?: any;
  created_at?: any;
  updated_at?: any;
  users?: User[] | null;
  user_ids?: any[] | null;
  user_permissions?: UserPermission[] | null;
  user_permission_ids?: any[] | null;
}
