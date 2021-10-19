import {NgModule} from '@angular/core';
import {Routes, RouterModule, PreloadAllModules} from '@angular/router';
import {Shell} from '@app/shell/shell.service';
import {AuthGuard} from "@shared/guards/auth.guard";

const routes: Routes = [
  Shell.childRoutes([
    {
      path: 'user',
      loadChildren: () => import('./user/user.module').then(m => m.UserModule),
      canActivate: [AuthGuard],
      data: {
        // roles: ['user', 'admin', 'super_admin']
      }
    },
    {
      path: 'admin',
      loadChildren: () => import('./admin/admin.module').then(m => m.AdminModule),
      canActivate: [AuthGuard],
      data: {
        // roles: ['admin', 'super_admin']
      }
    },
    {
      path: 'about',
      loadChildren: () => import('./about/about.module').then(m => m.AboutModule),
      canActivate: [AuthGuard],
      data: {
        // roles: ['user', 'admin', 'super_admin']
      }
    },
    {
      path: 'covalent',
      loadChildren: () => import('./covalent/covalent.module').then(m => m.CovalentModule),
      canActivate: [AuthGuard],
      data: {
        // roles: ['admin']
      }
    },
  ]),

  // Fallback when no prior route is matched
  {
    path: '**',
    redirectTo: '',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, {
      preloadingStrategy: PreloadAllModules
    })
  ],
  exports: [RouterModule],
  providers: []
})
export class AppRoutingModule {
}
