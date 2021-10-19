import {Component, OnDestroy, OnInit} from '@angular/core';
import {Editor} from "ngx-editor";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {RoleService} from "@app/admin/roles/services/role.service";
import {RolesListComponent} from "@app/admin/roles/components/roles-list/roles-list.component";
import {environment} from "@env/environment";

@Component({
  selector: 'app-roles-form',
  templateUrl: './roles-form.component.html',
  styleUrls: ['./roles-form.component.scss']
})
export class RolesFormComponent implements OnInit, OnDestroy {

  editor: Editor | any;

  files: File | FileList | any;
  disabled: boolean = false;

  hour = '23:59:59';

  environment = environment;

  constructor(
    public roleService: RoleService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public rolesListComponent: RolesListComponent,
  ) { }

  ngOnInit(): void {
    this.editor = new Editor();
  }

  ngOnDestroy(): void {
    this.editor.destroy();
  }

  // Permissions

  setUserPermissions(userPermissions: any[]) {
    if (!this.roleService.model.user_permissions) {
      this.roleService.model.user_permissions = null;
    }
    this.roleService.model.user_permissions = userPermissions;
  }

  setUserPermissionIds(userPermissions: any[]) {
    if (!userPermissions.length) {
      this.roleService.model.user_permission_ids = null;
    }
    this.roleService.model.user_permission_ids = userPermissions;
  }

  // Usuarios

  setUsers(users: any[]) {
    if (!this.roleService.model.users) {
      this.roleService.model.users = null;
    }
    this.roleService.model.users = users;
  }

  setUserIds(users: any[]) {
    if (!users.length) {
      this.roleService.model.user_ids = null;
    }
    this.roleService.model.user_ids = users;
  }

}
