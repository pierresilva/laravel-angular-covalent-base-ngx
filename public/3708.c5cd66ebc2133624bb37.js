(self.webpackChunkngxcovalent=self.webpackChunkngxcovalent||[]).push([[3708],{25414:(t,n,e)=>{"use strict";e.d(n,{W:()=>u});var a=e(37716),o=e(46669),i=e(7736);let u=(()=>{class t{constructor(t,n){this.media=t,this.mediaObserver=n,this.manageList=null,this.tdLayout=null,this.miniNav=!1,this.year=(new Date).getFullYear().toString()}toggleMiniNav(){this.miniNav=!this.miniNav,this.tdLayout.sidenav.toggle(),setTimeout(()=>{this.tdLayout.sidenav.toggle()})}get isMobile(){return this.mediaObserver.isActive("xs")||this.mediaObserver.isActive("sm")}}return t.\u0275fac=function(n){return new(n||t)(a.LFG(o.ze),a.LFG(i.u0))},t.\u0275prov=a.Yz7({token:t,factory:t.\u0275fac,providedIn:"root"}),t})()},33708:(t,n,e)=>{"use strict";e.r(n),e.d(n,{CovalentModule:()=>M});var a=e(38583),o=e(63423),i=e(70067),u=e(37716),r=e(25414),s=e(7676),l=e(77746),c=e(92859),g=e(76627),d=e(72458),m=e(1769);const v=function(){return{exact:!0}};let h=(()=>{class t{constructor(t){this.layoutService=t}ngOnInit(){}}return t.\u0275fac=function(n){return new(n||t)(u.Y36(r.W))},t.\u0275cmp=u.Xpm({type:t,selectors:[["app-covalent-module-menu"]],decls:29,vars:3,consts:[[3,"tdLayoutManageListToggle"],["mat-list-item","","routerLinkActive","active","routerLink","/covalent",3,"routerLinkActiveOptions"],["mat-list-icon","",2,"background","#e9e8e7a5"],["matLine",""],["mat-inset",""],["mat-list-item","","routerLinkActive","active","routerLink","/covalent/authors"]],template:function(t,n){1&t&&(u.TgZ(0,"mat-nav-list",0),u._uU(1,"\n\n  "),u.TgZ(2,"a",1),u._uU(3,"\n    "),u.TgZ(4,"mat-icon",2),u._uU(5,"local_library\n    "),u.qZA(),u._uU(6,"\n    "),u.TgZ(7,"h3",3),u._uU(8," Library "),u.qZA(),u._uU(9,"\n    "),u.TgZ(10,"p",3),u._uU(11," Library home"),u.qZA(),u._uU(12,"\n  "),u.qZA(),u._uU(13,"\n  "),u._UZ(14,"mat-divider",4),u._uU(15,"\n\n  "),u.TgZ(16,"a",5),u._uU(17,"\n    "),u.TgZ(18,"mat-icon",2),u._uU(19,"people\n    "),u.qZA(),u._uU(20,"\n    "),u.TgZ(21,"h3",3),u._uU(22," Authors "),u.qZA(),u._uU(23,"\n    "),u.TgZ(24,"p",3),u._uU(25," Books authors manage"),u.qZA(),u._uU(26,"\n  "),u.qZA(),u._uU(27,"\n\n"),u.qZA(),u._uU(28,"\n")),2&t&&(u.Q6J("tdLayoutManageListToggle",!n.layoutService.media.query("gt-sm")),u.xp6(2),u.Q6J("routerLinkActiveOptions",u.DdM(2,v)))},directives:[l.Hk,s.zM,l.Tg,o.yS,o.Od,c.YI,g.Hw,l.Nh,d.X2,m.d],styles:[""]}),t})();var p=e(12522),y=e(46669),_=e(51095);const U=["manageList"],L=["tdLayout"];function Z(t,n){1&t&&(u.TgZ(0,"button",8),u._uU(1,"\n        "),u.TgZ(2,"mat-icon"),u._uU(3,"menu"),u.qZA(),u._uU(4,"\n      "),u.qZA()),2&t&&u.Q6J("tdLayoutManageListToggle",!0)}function f(t,n){1&t&&(u.TgZ(0,"button",9),u._uU(1,"\n        "),u.TgZ(2,"mat-icon"),u._uU(3,"east"),u.qZA(),u._uU(4,"\n      "),u.qZA()),2&t&&u.Q6J("hideWhenOpened",!0)("tdLayoutManageListToggle",!0)}const b=[{path:"",component:(()=>{class t{constructor(t){this.layoutService=t,this.year=(new Date).getFullYear().toString()}ngOnInit(){}ngAfterViewInit(){this.layoutService.tdLayout=this.tdLayout,this.layoutService.manageList=this.manageList}}return t.\u0275fac=function(n){return new(n||t)(u.Y36(r.W))},t.\u0275cmp=u.Xpm({type:t,selectors:[["app-covalent-layout-manage-list"]],viewQuery:function(t,n){if(1&t&&(u.Gf(U,5),u.Gf(L,5)),2&t){let t;u.iGM(t=u.CRH())&&(n.manageList=t.first),u.iGM(t=u.CRH())&&(n.tdLayout=t.first)}},decls:31,vars:8,consts:[[1,"layout-main",3,"opened","mode"],["manageList",""],["td-sidenav-content","",2,"overflow-x","hidden"],["mat-icon-button","",3,"tdLayoutManageListToggle",4,"ngIf"],["mat-icon-button","",3,"hideWhenOpened","tdLayoutManageListToggle",4,"ngIf"],[2,"font-weight","bold"],["flex",""],["tdMediaToggle","gt-xs",1,"layout-main-content"],["mat-icon-button","",3,"tdLayoutManageListToggle"],["mat-icon-button","",3,"hideWhenOpened","tdLayoutManageListToggle"]],template:function(t,n){1&t&&(u._uU(0,"  "),u.TgZ(1,"td-layout-manage-list",0,1),u.ALo(3,"async"),u.ALo(4,"async"),u._uU(5,"\n\n    "),u._uU(6,"\n\n    "),u.TgZ(7,"div",2),u._uU(8,"\n      "),u._UZ(9,"app-covalent-module-menu"),u._uU(10,"\n    "),u.qZA(),u._uU(11,"\n\n    "),u.TgZ(12,"mat-toolbar"),u._uU(13,"\n\n      "),u.YNc(14,Z,5,1,"button",3),u._uU(15,"\n\n      "),u.YNc(16,f,5,2,"button",4),u._uU(17,"\n\n      "),u.TgZ(18,"h3",5),u._uU(19,"Covalent Library"),u.qZA(),u._uU(20,"\n\n      "),u._UZ(21,"span",6),u._uU(22,"\n\n      "),u._uU(23,"\n\n    "),u.qZA(),u._uU(24,"\n\n    "),u.TgZ(25,"div",7),u._uU(26,"\n\n      "),u._UZ(27,"router-outlet"),u._uU(28,"\n\n    "),u.qZA(),u._uU(29,"\n\n  "),u.qZA(),u._uU(30,"\n")),2&t&&(u.xp6(1),u.Q6J("opened",!!u.lcZ(3,4,n.layoutService.media.registerQuery("gt-sm")))("mode",u.lcZ(4,6,n.layoutService.media.registerQuery("gt-sm"))?"side":"over"),u.xp6(13),u.Q6J("ngIf",!n.layoutService.isMobile),u.xp6(2),u.Q6J("ngIf",n.layoutService.isMobile))},directives:[s.XW,h,p.Ye,a.O5,y.Cw,o.lC,_.lW,s.zM,g.Hw],pipes:[a.Ov],styles:["[_nghost-%COMP%]     .mat-drawer-inner-container .mat-toolbar.td-nagivation-drawer-toolbar{display:none!important}[_nghost-%COMP%]     .mat-nav-list.mat-list-base{padding-top:0}[_nghost-%COMP%]     .td-layout-nav-wrapper .mat-toolbar{z-index:2}[_nghost-%COMP%]     .td-layout-nav-wrapper .mat-toolbar.td-layout-toolbar{color:#e9e8e7!important}.layout-main-content[_ngcontent-%COMP%]{overflow-x:hidden}"],data:{animation:[i.uX]}}),t})(),children:[{path:"",loadChildren:()=>Promise.all([e.e(8592),e.e(2285)]).then(e.bind(e,32285)).then(t=>t.CovalentHomeModule)},{path:"authors",loadChildren:()=>e.e(7748).then(e.bind(e,7748)).then(t=>t.CovalentAuthorsModule)}]}];let A=(()=>{class t{}return t.\u0275fac=function(n){return new(n||t)},t.\u0275mod=u.oAB({type:t}),t.\u0275inj=u.cJS({imports:[[o.Bz.forChild(b)],o.Bz]}),t})();var T=e(71650);let M=(()=>{class t{}return t.\u0275fac=function(n){return new(n||t)},t.\u0275mod=u.oAB({type:t}),t.\u0275inj=u.cJS({imports:[[a.ez,T.m8,A]]}),t})()}}]);