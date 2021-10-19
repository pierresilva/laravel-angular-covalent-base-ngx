import {Component, OnDestroy, OnInit} from '@angular/core';
import {Editor} from "ngx-editor";
import {TdFileService} from "@covalent/core/file";
import {SnackBarService} from "@shared/services/snack-bar.service";
import {HttpApiService} from "@shared/services/http-api.service";
import {UserService} from "@app/admin/users/services/user.service";
import {UsersListComponent} from "@app/admin/users/components/users-list/users-list.component";

@Component({
  selector: 'app-users-form',
  templateUrl: './users-form.component.html',
  styleUrls: ['./users-form.component.scss']
})
export class UsersFormComponent implements OnInit, OnDestroy {

  editor: Editor | any;

  files: File | FileList | any;
  disabled: boolean = false;

  hour = '23:59:59';

  constructor(
    public userService: UserService,
    public fileUploadService: TdFileService,
    public snackBar: SnackBarService,
    public api: HttpApiService,
    public usersListComponent: UsersListComponent,
  ) {
    this.editor = new Editor();
  }

  ngOnInit(): void {
  }

  ngOnDestroy(): void {
    this.editor.destroy();
  }

  // Roles
  setUserRoles(userRoles: any[]) {
    if (!this.userService.model.user_roles) {
      this.userService.model.user_roles = null;
    }
    this.userService.model.user_roles = userRoles;
  }

  setUserRoleIds(userRoleIds: any[]) {
    if (!userRoleIds.length) {
      this.userService.model.user_role_ids = null;
    }
    this.userService.model.user_role_ids = userRoleIds;
  }

}
