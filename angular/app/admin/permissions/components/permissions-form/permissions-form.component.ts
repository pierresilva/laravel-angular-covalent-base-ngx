import {Component, OnDestroy, OnInit} from '@angular/core';
import {PermissionService} from "@app/admin/permissions/services/permission.service";
import {Editor} from "ngx-editor";
import {environment} from "@env/environment";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {RolesListComponent} from "@app/admin/roles/components/roles-list/roles-list.component";
import {PermissionsListComponent} from "@app/admin/permissions/components/permissions-list/permissions-list.component";

@Component({
  selector: 'app-permissions-form',
  templateUrl: './permissions-form.component.html',
  styleUrls: ['./permissions-form.component.scss']
})
export class PermissionsFormComponent implements OnInit, OnDestroy {

  editor: Editor | any;

  files: File | FileList | any;
  disabled: boolean = false;

  hour = '23:59:59';

  environment = environment;

  constructor(
    public permissionService: PermissionService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public permissionsListComponent: PermissionsListComponent,
  ) { }

  ngOnInit(): void {
    this.editor = new Editor();
  }

  ngOnDestroy(): void {
    this.editor.destroy();
  }

  // Roles

  setUserRoles(userRoles: any[]) {
    if (!this.permissionService.model.user_roles) {
      this.permissionService.model.user_roles = null;
    }
    this.permissionService.model.user_roles = userRoles;
  }

  setUserRoleIds(userRoles: any[]) {
    if (!userRoles.length) {
      this.permissionService.model.user_role_ids = null;
    }
    this.permissionService.model.user_role_ids = userRoles;
  }

}
