(self.webpackChunkngxcovalent=self.webpackChunkngxcovalent||[]).push([[936],{80936:(e,t,n)=>{"use strict";n.r(t),n.d(t,{BooksModule:()=>Te});var o=n(38583),s=n(63423),i=n(37716);let a=(()=>{class e{constructor(){}ngOnInit(){}}return e.\u0275fac=function(t){return new(t||e)},e.\u0275cmp=i.Xpm({type:e,selectors:[["app-books"]],decls:2,vars:0,template:function(e,t){1&e&&(i._UZ(0,"router-outlet"),i._uU(1,"\n"))},directives:[s.lC],styles:[""]}),e})();var r=n(50926),l=n(50115),c=n(89332),u=n(84962),d=n(48487),g=n(78739),h=n(29790);let p=(()=>{class e{constructor(e,t,n,o,s,i){this.api=e,this.router=t,this.snackBar=n,this._loadingService=o,this._dialogService=s,this.translate=i,this.path="books",this.items=[],this.selectedItems=[],this.item={},this.model={},this.apiMeta={},this.searchTerm=null,this.sortBy="id",this.sortDirection="desc",this.sortOrder=l.x7.Descending,this.perPage=20,this.isLoading=!1,this.overlayStarSyntax=!1,this.selectable=!0,this.selectedRows=[],this.clickable=!1,this.multiple=!0,this.resizableColumns=!1,this.columns=[{name:"title",label:this.translate.instant("TITLE"),sortable:!0},{name:"published_at",label:this.translate.instant("PUBLISHED_AT"),sortable:!0},{name:"genre.name",label:this.translate.instant("GENRE"),sortable:!0},{name:"id",label:"",sortable:!1,width:60}]}filter(e){console.log(e)}sort(e){console.log(e)}page(e=null){console.log(e)}refreshTable(e=null){console.log(e)}showAlert(e=null){console.log(e)}getItems(e=1){this.isLoading=!0,this.api.get("api/"+this.path+"?page="+e+"&per-page="+this.perPage+this.getSortString()+this.getSearchString()).subscribe(e=>{this.items=e.data,this.apiMeta=e.meta,this.isLoading=!1},e=>{this.isLoading=!1})}getItem(e){this.isLoading=!0,this.api.get("api/"+this.path+"/"+e).subscribe(e=>{this.edit(e.data),this.isLoading=!1},e=>{this.isLoading=!1})}setItem(e){this.item=e}save(){this.model.id?this.update():this.store()}store(){console.log("store",this.model),this.api.post("api/"+this.path,{model:this.model}).subscribe(e=>{this.model={},this.snackBar.success(e.message),this.getItems(),this.sidenav.close(),this.router.navigateByUrl("/admin/{{{ $name|name_name}}}")},e=>{let t="";for(const n in e.errors)t=e.errors[n][0];this.snackBar.error(t)})}update(){this.api.put("api/"+this.path+"/"+this.model.id,{model:this.model}).subscribe(e=>{this.model={},this.snackBar.success(e.message),this.getItems(),this.sidenav.close(),this.router.navigateByUrl("/admin/books")},e=>{console.log(e);let t="";for(const n in e.errors)t=e.errors[n][0];this.snackBar.error(t)})}delete(e){this._dialogService.openConfirm({title:"Eliminar item",message:"Realmente desea realizar esta acci\xf3n?",cancelButton:"Cancelar",acceptButton:"Eliminar",width:"350px",disableClose:!0}).afterClosed().subscribe(t=>{t&&this.api.delete("api/"+this.path+"/"+e).subscribe(e=>{this.model={},this.snackBar.success(e.message),this.getItems()},e=>{this.snackBar.error(e.error.message)})})}deleteMultiple(){this._dialogService.openConfirm({title:"Eliminar "+this.selectedItems.length+" items",message:"Realmente desea realizar esta acci\xf3n?",cancelButton:"Cancelar",acceptButton:"Eliminar",width:"350px",disableClose:!0}).afterClosed().subscribe(e=>{if(e){let e=[];for(let t=0;t<this.selectedItems.length;t++)e.push(this.selectedItems[t].id);this.api.put("api/"+this.path+"/delete-multiple",{ids:e}).subscribe(e=>{this.snackBar.success(e.message),this.getItems(),this.selectedItems=[]},e=>{this.snackBar.error(e.error.message)})}})}edit(e){this.model=Object.assign({},e)}getSortString(){return"&sort="+JSON.stringify({column:this.sortBy,direction:this.sortDirection})}getSearchString(){let e=[];if(this.searchTerm&&""!==this.searchTerm)for(let t=0;t<this.columns.length;t++)"id"!==this.columns[t].name&&e.push({column:this.columns[t].name,operator:"cont",text:this.searchTerm});return"&query="+JSON.stringify(e)}setPerPage(e){this.perPage=e.source.value}setSearchTerm(e){console.log(e),this.searchTerm=e}setSortBy(e){this.sortBy=e.name,this.sortDirection=e.order.toLowerCase()}toggleLoading(e){"close"===e&&this._loadingService.resolve(),"open"===e&&this._loadingService.register()}}return e.\u0275fac=function(t){return new(t||e)(i.LFG(c.O),i.LFG(s.F0),i.LFG(u.c),i.LFG(d.bI),i.LFG(g.s$),i.LFG(h.sK))},e.\u0275prov=i.Yz7({token:e,factory:e.\u0275fac,providedIn:"root"}),e})();var m=n(66182);const b=["sidenav"];function _(e,t){1&e&&(i.TgZ(0,"span",11),i.TgZ(1,"span",12),i._uU(2,"BOOKS"),i.qZA(),i.qZA())}function f(e,t){if(1&e){const e=i.EpF();i.TgZ(0,"button",13),i.NdJ("click",function(){return i.CHM(e),i.oxw(2).bookService.deleteMultiple()}),i._uU(1,"\n         "),i.TgZ(2,"span",12),i._uU(3,"Delete"),i.qZA(),i._uU(4),i.qZA()}if(2&e){const e=i.oxw(2);i.Q6J("color","warn"),i.xp6(4),i.hij(" ",e.bookService.selectedItems.length," item(s)\n       ")}}function Z(e,t){if(1&e&&(i.TgZ(0,"span",8),i._uU(1,"\n       "),i.YNc(2,_,3,0,"span",9),i._uU(3,"\n       "),i.YNc(4,f,5,2,"button",10),i._uU(5,"\n     "),i.qZA()),2&e){const e=i.oxw();i.xp6(2),i.Q6J("ngIf",e.bookService.selectable&&!e.bookService.selectedItems.length||!e.bookService.selectable),i.xp6(2),i.Q6J("ngIf",e.bookService.selectedItems.length&&e.bookService.selectable)}}function U(e,t){if(1&e&&(i._uU(0,"\n        "),i.TgZ(1,"span",19),i._uU(2),i.ALo(3,"dateFormat"),i.qZA(),i._uU(4,"\n\n      ")),2&e){const e=t.value;i.xp6(1),i.Q6J("title",e),i.xp6(1),i.Oqu(i.lcZ(3,2,e))}}function v(e,t){if(1&e&&(i._uU(0,"\n        "),i.TgZ(1,"span",19),i._uU(2),i.qZA(),i._uU(3,"\n\n      ")),2&e){const e=t.value;i.xp6(1),i.Q6J("title",e),i.xp6(1),i.Oqu(e)}}function A(e,t){if(1&e){const e=i.EpF();i._uU(0,"\n        "),i.TgZ(1,"button",20),i.NdJ("click",function(){const t=i.CHM(e).value,n=i.oxw(2),o=i.MAs(3);return n.bookService.getItem(t),o.sidenav.open()}),i._uU(2,"\n          "),i.TgZ(3,"mat-icon"),i._uU(4,"edit"),i.qZA(),i._uU(5,"\n        "),i.qZA(),i._uU(6,"\n      ")}if(2&e){const e=t.value;i.xp6(1),i.Q6J("routerLink","/admin/books/"+e)}}const k=function(e,t){return{"layout-mat-sidenav-container":e,"layout-mat-sidenav-container-mobile":t}};function S(e,t){if(1&e){const e=i.EpF();i.ynx(0),i._uU(1,"\n    "),i.TgZ(2,"td-data-table",14,15),i.NdJ("ngModelChange",function(t){return i.CHM(e),i.oxw().bookService.selectedItems=t})("sortChange",function(t){i.CHM(e);const n=i.oxw();return n.bookService.setSortBy(t),n.bookService.getItems()})("rowClick",function(){return null}),i._uU(4,"\n\n\n      "),i.YNc(5,U,5,4,"ng-template",16),i._uU(6,"\n\n      "),i.YNc(7,v,4,2,"ng-template",17),i._uU(8,"\n\n      "),i.YNc(9,A,7,1,"ng-template",18),i._uU(10,"\n\n    "),i.qZA(),i._uU(11,"\n\n  "),i.BQk()}if(2&e){const e=i.oxw();i.xp6(2),i.Q6J("ngClass",i.WLB(11,k,!e.layoutService.isMobile,e.layoutService.isMobile))("data",e.bookService.items)("columns",e.bookService.columns)("selectable",e.bookService.selectable)("clickable",e.bookService.clickable)("multiple",e.bookService.multiple)("sortable",!0)("sortBy","id")("resizableColumns",!1)("ngModel",e.bookService.selectedItems)("sortOrder",e.bookService.sortOrder)}}function x(e,t){1&e&&(i.ynx(0),i._uU(1,"\n    "),i.TgZ(2,"div",21),i._uU(3,"\n      "),i.TgZ(4,"mat-icon",22),i._uU(5,"people\n      "),i.qZA(),i._uU(6,"\n      "),i.TgZ(7,"h2"),i.TgZ(8,"span",12),i._uU(9,"No"),i.qZA(),i._uU(10," "),i.TgZ(11,"span",12),i._uU(12,"BOOKS"),i.qZA(),i._uU(13," "),i.TgZ(14,"span",12),i._uU(15,"available"),i.qZA(),i.qZA(),i._uU(16,"\n    "),i.qZA(),i._uU(17,"\n  "),i.BQk())}function T(e,t){if(1&e){const e=i.EpF();i.TgZ(0,"mat-option",31),i.NdJ("onSelectionChange",function(t){i.CHM(e);const n=i.oxw(2);return n.bookService.setPerPage(t),n.bookService.getItems()}),i._uU(1),i.qZA()}if(2&e){const e=t.$implicit;i.Q6J("value",e),i.xp6(1),i.hij("\n        ",e,"\n      ")}}const I=function(){return[20,50,100]};function q(e,t){if(1&e){const e=i.EpF();i.TgZ(0,"td-paging-bar",23,24),i.NdJ("change",function(t){return i.CHM(e),i.oxw().bookService.getItems(t.page)}),i._uU(2,"\n    "),i.TgZ(3,"a",25),i._uU(4,"\n      "),i.TgZ(5,"mat-icon"),i._uU(6,"file_download"),i.qZA(),i._uU(7,"\n    "),i.qZA(),i._uU(8,"\n\n    "),i.TgZ(9,"button",26),i.NdJ("click",function(){i.CHM(e);const t=i.oxw(),n=i.MAs(3);return t.bookService.model={id:0},t.router.navigateByUrl("/admin/books/0"),n.sidenav.open()}),i._uU(10,"\n      "),i.TgZ(11,"mat-icon"),i._uU(12,"add"),i.qZA(),i._uU(13,"\n    "),i.qZA(),i._uU(14,"\n\n    "),i._UZ(15,"span",0),i._uU(16,"\n    "),i.TgZ(17,"span",27),i._uU(18,"Per page"),i.qZA(),i._uU(19,":\n    "),i.TgZ(20,"mat-select",28),i.NdJ("ngModelChange",function(t){return i.CHM(e),i.oxw().bookService.perPage=t}),i._uU(21,"\n      "),i.YNc(22,T,2,2,"mat-option",29),i._uU(23,"\n    "),i.qZA(),i._uU(24),i.TgZ(25,"span",30),i.TgZ(26,"span",12),i._uU(27,"of"),i.qZA(),i._uU(28),i.qZA(),i._uU(29,"\n  "),i.qZA()}if(2&e){const e=i.MAs(1),t=i.oxw();i.Q6J("pageSize",t.bookService.perPage)("total",t.bookService.apiMeta.total),i.xp6(3),i.Q6J("href",t.environment.url+"/api/books/export",i.LSH),i.xp6(17),i.Udp("width",50,"px"),i.Q6J("ngModel",t.bookService.perPage),i.xp6(2),i.Q6J("ngForOf",i.DdM(9,I)),i.xp6(2),i.hij("\n    ",e.range,"\n    "),i.xp6(4),i.hij(" ",e.total,"")}}const M=function(e){return{display:e}};let C=(()=>{class e{constructor(e,t,n,o){this.bookService=e,this.layoutService=t,this.router=n,this.activatedRoute=o}ngOnInit(){this.bookService.getItems(),this.environment=r.N}ngAfterViewInit(){this.bookService.sidenav=this.sidenav.sidenav,this.activatedRoute.snapshot.params.id&&(0!=this.activatedRoute.snapshot.params.id?this.bookService.getItem(this.activatedRoute.snapshot.params.id):this.bookService.model={id:0},this.sidenav.sidenav.open())}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(p),i.Y36(m.d),i.Y36(s.F0),i.Y36(s.gz))},e.\u0275cmp=i.Xpm({type:e,selectors:[["app-books-list"]],viewQuery:function(e,t){if(1&e&&i.Gf(b,5),2&e){let e;i.iGM(e=i.CRH())&&(t.sidenav=e.first)}},decls:24,vars:14,consts:[["flex",""],["sidenav",""],["layout","row","layout-align","start center",1,"pad-left-sm","pad-right-sm",2,"min-height","53px"],["class","push-left-sm",4,"ngIf"],["backIcon","arrow_back","flex","",1,"push-right-sm",3,"ngStyle","placeholder","close","searchDebounce"],["searchBox",""],[4,"ngIf"],[3,"pageSize","total","change",4,"ngIf"],[1,"push-left-sm"],["class","mat-title uppercase",4,"ngIf"],["mat-flat-button","",3,"color","click",4,"ngIf"],[1,"mat-title","uppercase"],["translate",""],["mat-flat-button","",3,"color","click"],[3,"ngClass","data","columns","selectable","clickable","multiple","sortable","sortBy","resizableColumns","ngModel","sortOrder","ngModelChange","sortChange","rowClick"],["dataTable",""],["tdDataTableTemplate","published_at"],["tdDataTableTemplate","genre.name"],["tdDataTableTemplate","id"],["matLine","",3,"title"],["mat-icon-button","",2,"margin-left","-26px",3,"routerLink","click"],["layout","column","layout-align","center center",1,"tc-grey-500","mat-typography","pad-lg"],["matListAvatar","",1,"text-super","push-bottom"],[3,"pageSize","total","change"],["pagingBar",""],["mat-mini-fab","","color","info","target","_blank",3,"href"],["mat-mini-fab","","color","success",3,"click"],["hide-xs","","translate",""],["hide-xs","",3,"ngModel","ngModelChange"],[3,"value","onSelectionChange",4,"ngFor","ngForOf"],["hide-xs",""],[3,"value","onSelectionChange"]],template:function(e,t){if(1&e&&(i.TgZ(0,"mat-sidenav-container",0),i._uU(1,"\n\n  "),i._UZ(2,"app-books-sidenav",null,1),i._uU(4,"\n\n  "),i.TgZ(5,"div",2),i._uU(6,"\n     "),i.YNc(7,Z,6,2,"span",3),i._uU(8,"\n    "),i.TgZ(9,"td-search-box",4,5),i.NdJ("close",function(){return t.bookService.setSearchTerm(null),t.bookService.getItems()})("searchDebounce",function(e){return t.bookService.setSearchTerm(e),t.bookService.getItems()}),i.ALo(11,"translate"),i.ALo(12,"translate"),i.qZA(),i._uU(13,"\n  "),i.qZA(),i._uU(14,"\n  "),i._UZ(15,"mat-divider"),i._uU(16,"\n\n  "),i.YNc(17,S,12,14,"ng-container",6),i._uU(18,"\n\n  "),i.YNc(19,x,18,0,"ng-container",6),i._uU(20,"\n\n\n  "),i.YNc(21,q,30,10,"td-paging-bar",7),i._uU(22,"\n\n"),i.qZA(),i._uU(23,"\n")),2&e){const e=i.MAs(10);i.xp6(5),i.ekj("mat-selected-title",t.bookService.selectedItems.length&&t.bookService.selectable),i.xp6(2),i.Q6J("ngIf",!e.searchVisible),i.xp6(2),i.Q6J("ngStyle",i.VKq(12,M,t.bookService.selectedItems.length?"none":"block"))("placeholder",i.lcZ(11,8,"Search")+" "+i.lcZ(12,10,"BOOK")),i.xp6(8),i.Q6J("ngIf",t.bookService.items.length),i.xp6(2),i.Q6J("ngIf",!t.bookService.items.length),i.xp6(2),i.Q6J("ngIf",t.bookService.items.length)}},styles:[".layout-mat-sidenav-container[_ngcontent-%COMP%]{height:calc(100vh - 230px)}.layout-mat-sidenav-container-mobile[_ngcontent-%COMP%]{height:calc(100vh - 214px)}[_nghost-%COMP%]     mat-sidenav-content{overflow-x:hidden}[_nghost-%COMP%]     .td-data-table-scrollable{-ms-overflow-style:none;scrollbar-width:none}[_nghost-%COMP%]     .td-data-table-scrollable::-webkit-scrollbar{display:none}"]}),e})();const L=[{path:"",component:a,children:[{path:"",component:C},{path:":id",component:C}]}];let y=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=i.oAB({type:e}),e.\u0275inj=i.cJS({imports:[[s.Bz.forChild(L)],s.Bz]}),e})();var J=n(23017),O=n(12522),w=n(51095),N=n(76627),B=n(88030),F=n(37406),Q=n(91233),E=n(3679),D=n(98295),Y=n(49983),P=n(54395),H=n(68307),G=n(43190),R=n(68939),j=n(91841),z=n(21554),X=n(58341),K=n(72458),$=n(92859);function V(e,t){1&e&&(i.ynx(0),i._uU(1," *"),i.BQk())}function W(e,t){if(1&e&&(i.TgZ(0,"h4",9),i._uU(1),i.YNc(2,V,2,0,"ng-container",7),i._uU(3,"\n"),i.qZA()),2&e){const e=i.oxw();i.xp6(1),i.hij("",e.label,"\n  "),i.xp6(1),i.Q6J("ngIf",e.required)}}function ee(e,t){if(1&e){const e=i.EpF();i.TgZ(0,"mat-chip-list",10),i._uU(1,"\n  "),i.TgZ(2,"mat-chip",11),i.NdJ("removed",function(){return i.CHM(e),i.oxw().removeItem()}),i._uU(3,"\n    "),i.ynx(4),i._uU(5,"\n      "),i.TgZ(6,"span"),i.TgZ(7,"b"),i._uU(8),i.qZA(),i.qZA(),i._uU(9,"\n    "),i.BQk(),i._uU(10,"\n    "),i._UZ(11,"span",12),i._uU(12,"\n    "),i.TgZ(13,"button",13),i._uU(14,"\n      "),i.TgZ(15,"mat-icon"),i._uU(16,"cancel"),i.qZA(),i._uU(17,"\n    "),i.qZA(),i._uU(18,"\n  "),i.qZA(),i._uU(19,"\n"),i.qZA()}if(2&e){const e=i.oxw();i.xp6(2),i.Q6J("removable",!0),i.xp6(6),i.Oqu(e.selected.name)}}function te(e,t){if(1&e&&(i.TgZ(0,"mat-option",14),i._uU(1),i.qZA()),2&e){const e=i.oxw();i.xp6(1),i.hij("",e.loadingText,"\n    ")}}function ne(e,t){if(1&e&&(i.ynx(0),i._uU(1,"\n          "),i.TgZ(2,"span"),i.TgZ(3,"b"),i._uU(4),i.qZA(),i.qZA(),i._uU(5,"\n        "),i.BQk()),2&e){const e=t.$implicit,n=i.oxw().$implicit;i.xp6(4),i.Oqu(n[e])}}function oe(e,t){if(1&e){const e=i.EpF();i.TgZ(0,"mat-option",16),i.NdJ("onSelectionChange",function(){const t=i.CHM(e).$implicit;return i.oxw(2).addItem(t)}),i._uU(1,"\n        "),i.YNc(2,ne,6,1,"ng-container",17),i._uU(3,"\n\n      "),i.qZA()}if(2&e){const e=t.$implicit,n=i.oxw(2);i.Q6J("value",e.id),i.xp6(2),i.Q6J("ngForOf",n.searchDisplayColumns)}}function se(e,t){if(1&e&&(i.ynx(0),i._uU(1,"\n      "),i.YNc(2,oe,4,2,"mat-option",15),i._uU(3,"\n    "),i.BQk()),2&e){const e=i.oxw();i.xp6(2),i.Q6J("ngForOf",e.filteredData)}}function ie(e,t){if(1&e&&(i.ynx(0),i._uU(1,"\n              "),i.TgZ(2,"a",19),i._uU(3),i.qZA(),i._uU(4,"\n            "),i.BQk()),2&e){const e=i.oxw(2);i.xp6(2),i.Q6J("routerLink",e.notFoundUrl),i.xp6(1),i.Oqu(e.notFoundButtonText)}}function ae(e,t){if(1&e&&(i.ynx(0),i._uU(1,"\n      "),i.TgZ(2,"mat-option",18),i._uU(3,"\n          "),i.TgZ(4,"span"),i._uU(5,"\n            "),i.TgZ(6,"b"),i._uU(7),i.qZA(),i._uU(8,"\n            "),i.YNc(9,ie,5,2,"ng-container",7),i._uU(10,"\n          "),i.qZA(),i._uU(11,"\n      "),i.qZA(),i._uU(12,"\n    "),i.BQk()),2&e){const e=i.oxw();i.xp6(2),i.Q6J("value",null),i.xp6(5),i.Oqu(e.notFoundMessage),i.xp6(2),i.Q6J("ngIf",e.notFoundUrl&&e.notFoundButtonText)}}function re(e,t){if(1&e&&(i.TgZ(0,"mat-hint",20),i._uU(1,"\n    "),i.TgZ(2,"span",21),i._uU(3,"Assign one"),i.qZA(),i._uU(4," "),i.TgZ(5,"span",21),i._uU(6),i.qZA(),i._uU(7,"\n  "),i.qZA()),2&e){const e=i.oxw();i.xp6(6),i.Oqu(e.label)}}let le=(()=>{class e{constructor(e,t){this.http=e,this.snackBar=t,this.searchUrl=null,this.searchColumns=["name"],this.searchDisplayColumns=["name"],this.searchInputLabel="Buscar item",this.searchInputPlaceholder="Buscar...",this.notFoundMessage="No items found",this.notFoundButtonText=null,this.notFoundUrl=null,this.loadingText="Buscando...",this.required=!1,this.label=null,this.selectOut=new i.vpe,this.selectIdOut=new i.vpe,this.searchInput=new E.NI,this.searchString="",this.filteredData=[],this.isLoading=!1,this.errorMessage=""}ngOnInit(){this.filterData()}getSearchString(e){let t=[];return this.searchColumns.map(n=>{t.push({column:n,operator:"cont",text:e})}),"&query="+JSON.stringify(t)}filterData(){this.searchInput.valueChanges.pipe((0,P.b)(500),(0,H.b)(()=>{this.errorMessage="",this.filteredData=[],this.isLoading=!0}),(0,G.w)(e=>this.http.get(this.searchUrl+"?per_page=100"+this.getSearchString(e)).pipe((0,R.x)(()=>{this.isLoading=!1})))).subscribe(e=>{null==e.data?(this.errorMessage=e.message,this.filteredData=[]):(this.errorMessage="",this.filteredData=e.data)})}addItem(e){this.selectedId=e.id,this.selected=e,this.searchInput.setValue(""),this.selectOut.emit(this.selected),this.selectIdOut.emit(this.selectedId)}removeItem(){this.selected=null,this.selectedId=null,this.selectOut.emit(this.selected),this.selectIdOut.emit(this.selectedId)}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(j.eN),i.Y36(u.c))},e.\u0275cmp=i.Xpm({type:e,selectors:[["app-belongs-to-input"]],inputs:{selected:"selected",selectedId:"selectedId",searchUrl:"searchUrl",searchColumns:"searchColumns",searchDisplayColumns:"searchDisplayColumns",searchInputLabel:"searchInputLabel",searchInputPlaceholder:"searchInputPlaceholder",notFoundMessage:"notFoundMessage",notFoundButtonText:"notFoundButtonText",notFoundUrl:"notFoundUrl",loadingText:"loadingText",required:"required",label:"label"},outputs:{selectOut:"selectOut",selectIdOut:"selectIdOut"},decls:25,vars:10,consts:[["style","margin-bottom: 0;",4,"ngIf"],["class","mat-chip-list-stacked",4,"ngIf"],["appearance","outline",2,"width","100%"],["matInput","",3,"formControl","placeholder","matAutocomplete"],["dataSearch",""],["autocompleteTags","matAutocomplete"],["class","is-loading",4,"ngIf"],[4,"ngIf"],["style","color: red;",4,"ngIf"],[2,"margin-bottom","0"],[1,"mat-chip-list-stacked"],[3,"removable","removed"],["flex",""],["matChipRemove",""],[1,"is-loading"],[3,"value","onSelectionChange",4,"ngFor","ngForOf"],[3,"value","onSelectionChange"],[4,"ngFor","ngForOf"],[3,"value"],["mat-button","",3,"routerLink"],[2,"color","red"],["translate",""]],template:function(e,t){if(1&e&&(i.YNc(0,W,4,2,"h4",0),i._uU(1,"\n"),i.YNc(2,ee,20,2,"mat-chip-list",1),i._uU(3,"\n"),i.TgZ(4,"mat-form-field",2),i._uU(5,"\n  "),i.TgZ(6,"mat-label"),i._uU(7),i.qZA(),i._uU(8,"\n  "),i._UZ(9,"input",3,4),i._uU(11,"\n  "),i.TgZ(12,"mat-autocomplete",null,5),i._uU(14,"\n    "),i.YNc(15,te,2,1,"mat-option",6),i._uU(16,"\n    "),i.YNc(17,se,4,1,"ng-container",7),i._uU(18,"\n    "),i.YNc(19,ae,13,3,"ng-container",7),i._uU(20,"\n  "),i.qZA(),i._uU(21,"\n  "),i.YNc(22,re,8,1,"mat-hint",8),i._uU(23,"\n"),i.qZA(),i._uU(24,"\n\n")),2&e){const e=i.MAs(13);i.Q6J("ngIf",t.label),i.xp6(2),i.Q6J("ngIf",t.selected),i.xp6(5),i.Oqu(t.searchInputLabel),i.xp6(2),i.Q6J("formControl",t.searchInput)("placeholder",t.searchInputPlaceholder)("matAutocomplete",e),i.xp6(6),i.Q6J("ngIf",t.isLoading),i.xp6(2),i.Q6J("ngIf",!t.isLoading&&t.filteredData.length),i.xp6(2),i.Q6J("ngIf",!t.isLoading&&!t.filteredData.length),i.xp6(3),i.Q6J("ngIf",t.required&&!t.selectedId)}},directives:[o.O5,D.KE,D.hX,Y.Nt,E.Fj,z.ZL,E.JJ,E.oH,z.XC,X.qn,X.HS,X.qH,N.Hw,K.ey,o.sg,w.zs,s.yS,$.YI,D.bx,h.Pi],styles:[""]}),e})();var ce=n(12073);function ue(e,t){1&e&&(i.TgZ(0,"mat-error",33),i.TgZ(1,"span",4),i._uU(2,"This field is required"),i.qZA(),i._uU(3,"\n      "),i.qZA())}function de(e,t){if(1&e&&i._UZ(0,"img",34),2&e){const e=i.oxw();i.Q6J("src",e.bookService.model.cover,i.LSH)}}function ge(e,t){if(1&e&&(i.TgZ(0,"pre"),i._uU(1),i.ALo(2,"json"),i.qZA()),2&e){const e=i.oxw();i.xp6(1),i.hij("",i.lcZ(2,1,e.bookService.model),"\n  ")}}const he=function(){return["name"]},pe=function(){return[]};let me=(()=>{class e{constructor(e,t,n,o,s){this.bookService=e,this.fileUploadService=t,this.snackBar=n,this.api=o,this.booksListComponent=s,this.disabled=!1,this.hour="23:59:59",this.environment=r.N,this.editor_resume=new F.ML}ngOnInit(){}ngOnDestroy(){this.editor_resume.destroy()}selectCoverEvent(e){if(e instanceof FileList);else{let t=new FormData;t.set("file",e),this.api.post("/api/uploads",t).subscribe(e=>{this.bookService.model.cover=e.data.url,this.snackBar.success(e.message)},e=>{this.snackBar.warning(e.errors.file[0])})}}setGenre(e){e||(this.bookService.model.genre=null),this.bookService.model.genre=e}setGenreId(e){e||(this.bookService.model.genre_id=null),this.bookService.model.genre_id=e}setTags(e){e.length||(this.bookService.model.tags=[]),this.bookService.model.tags=e}setTagIds(e){e.length||(this.bookService.model.tag_ids=null),this.bookService.model.tag_ids=e}setAuthors(e){e.length||(this.bookService.model.authors=[]),this.bookService.model.authors=e}setAuthorIds(e){e.length||(this.bookService.model.author_ids=null),this.bookService.model.author_ids=e}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(p),i.Y36(Q.fl),i.Y36(u.c),i.Y36(c.O),i.Y36(C))},e.\u0275cmp=i.Xpm({type:e,selectors:[["app-books-form"]],decls:141,vars:152,consts:[["flex","",1,"pad"],["novalidate","",3,"ngSubmit"],["booksForm","ngForm"],["appearance","outline",2,"width","100%"],["translate",""],["matInput","","type","text","name","title","id","title","required","",3,"placeholder","ngModel","ngModelChange"],["title","ngModel"],["class","error",4,"ngIf"],["matPrefix","","style","max-height: 32px; max-width: 32px; margin-right: 0.5rem;",3,"src",4,"ngIf"],["matInput","","type","text",3,"name","id","placeholder","ngModel","ngModelChange"],["cover","ngModel"],["matSuffix","","color","primary","accept",".jpg,.png",3,"name","ngModel","disabled","multiple","ngModelChange","select"],["matInput","","type","date",3,"name","id","placeholder","ngModel","ngModelChange"],["published_at","ngModel"],["matInput","","type","datetime-local","name","bought_at","id","bought_at",3,"placeholder","ngModel","ngModelChange"],["bought_at","ngModel"],[2,"margin-top","0","margin-bottom","0.5rem"],[1,"NgxEditor__Wrapper",2,"margin-bottom","1rem"],[3,"editor"],[3,"name","id","editor","ngModel","disabled","placeholder","ngModelChange"],["resume","ngModel"],["type","hidden","name","genre_id","id","genre_id","required","",3,"ngModel","ngModelChange"],["genre_id","ngModel"],[3,"label","required","searchInputLabel","searchInputPlaceholder","selected","selectedId","searchUrl","searchDisplayColumns","searchColumns","notFoundUrl","notFoundButtonText","notFoundMessage","selectOut","selectIdOut"],["type","hidden","name","tag_ids","id","tag_ids",3,"ngModel","required","ngModelChange"],["tag_ids","ngModel"],[3,"label","min","required","searchInputLabel","searchInputPlaceholder","selected","selectedIds","searchUrl","searchDisplayColumns","searchColumns","notFoundUrl","notFoundButtonText","notFoundMessage","selectOut","selectIdsOut"],["type","hidden","name","author_ids","id","author_ids",3,"ngModel","required","ngModelChange"],["author_ids","ngModel"],[1,"pad-top-lg"],["mat-raised-button","","color","success",1,"text-upper",3,"disabled","click"],["mat-button","","color","warn",1,"text-upper",3,"click"],[4,"ngIf"],[1,"error"],["matPrefix","",2,"max-height","32px","max-width","32px","margin-right","0.5rem",3,"src"]],template:function(e,t){if(1&e&&(i.TgZ(0,"div",0),i._uU(1,"\n\n  "),i.TgZ(2,"form",1,2),i.NdJ("ngSubmit",function(){return t.bookService.save()}),i._uU(4,"\n\n    "),i.TgZ(5,"mat-form-field",3),i._uU(6,"\n      "),i.TgZ(7,"mat-label"),i.TgZ(8,"span",4),i._uU(9,"TITLE"),i.qZA(),i.qZA(),i._uU(10,"\n      "),i.TgZ(11,"input",5,6),i.NdJ("ngModelChange",function(e){return t.bookService.model.title=e}),i.ALo(13,"translate"),i.ALo(14,"translate"),i.qZA(),i._uU(15,"\n      "),i.YNc(16,ue,4,0,"mat-error",7),i._uU(17,"\n    "),i.qZA(),i._uU(18,"\n    "),i.TgZ(19,"mat-form-field",3),i._uU(20,"\n        "),i.TgZ(21,"mat-label"),i.TgZ(22,"span",4),i._uU(23,"COVER"),i.qZA(),i.qZA(),i._uU(24,"\n            "),i.YNc(25,de,1,1,"img",8),i._uU(26,"\n            "),i.TgZ(27,"input",9,10),i.NdJ("ngModelChange",function(e){return t.bookService.model.cover=e}),i.ALo(29,"translate"),i.qZA(),i._uU(30,"\n            "),i.TgZ(31,"td-file-input",11),i.NdJ("ngModelChange",function(e){return t.files=e})("select",function(e){return t.selectCoverEvent(e)}),i._uU(32,"\n              "),i.TgZ(33,"mat-icon"),i._uU(34,"attach_file"),i.qZA(),i._uU(35,"\n            "),i.qZA(),i._uU(36,"\n    "),i.qZA(),i._uU(37,"\n    "),i.TgZ(38,"mat-form-field",3),i._uU(39,"\n        "),i.TgZ(40,"mat-label"),i.TgZ(41,"span",4),i._uU(42,"PUBLISHED_AT"),i.qZA(),i.qZA(),i._uU(43,"\n        "),i.TgZ(44,"input",12,13),i.NdJ("ngModelChange",function(e){return t.bookService.model.published_at=e}),i.ALo(46,"translate"),i.ALo(47,"translate"),i.qZA(),i._uU(48,"\n      "),i.qZA(),i._uU(49,"\n    "),i.TgZ(50,"mat-form-field",3),i._uU(51,"\n        "),i.TgZ(52,"mat-label"),i.TgZ(53,"span",4),i._uU(54,"BOUGHT_AT"),i.qZA(),i.qZA(),i._uU(55,"\n        "),i.TgZ(56,"input",14,15),i.NdJ("ngModelChange",function(e){return t.bookService.model.bought_at=e}),i.ALo(58,"translate"),i.ALo(59,"translate"),i.qZA(),i._uU(60,"\n      "),i.qZA(),i._uU(61,"\n        "),i.TgZ(62,"h4",16),i.TgZ(63,"span",4),i._uU(64,"RESUME"),i.qZA(),i.qZA(),i._uU(65,"\n        "),i.TgZ(66,"div",17),i._uU(67,"\n          "),i._UZ(68,"ngx-editor-menu",18),i._uU(69,"\n          "),i.TgZ(70,"ngx-editor",19,20),i.NdJ("ngModelChange",function(e){return t.bookService.model.resume=e}),i.ALo(72,"translate"),i.ALo(73,"translate"),i.qZA(),i._uU(74,"\n        "),i.qZA(),i._uU(75,"\n    "),i.TgZ(76,"input",21,22),i.NdJ("ngModelChange",function(e){return t.bookService.model.genre_id=e}),i.qZA(),i._uU(78,"\n    "),i._uU(79,"\n    "),i.TgZ(80,"app-belongs-to-input",23),i.NdJ("selectOut",function(e){return t.setGenre(e)})("selectIdOut",function(e){return t.setGenreId(e)}),i.ALo(81,"translate"),i.ALo(82,"translate"),i.ALo(83,"translate"),i.ALo(84,"translate"),i.ALo(85,"translate"),i.ALo(86,"translate"),i.ALo(87,"translate"),i.ALo(88,"translate"),i.ALo(89,"translate"),i.qZA(),i._uU(90,"\n    "),i.TgZ(91,"input",24,25),i.NdJ("ngModelChange",function(e){return t.bookService.model.tag_ids=e}),i.qZA(),i._uU(93,"\n    "),i._uU(94,"\n    "),i.TgZ(95,"app-belongs-to-many-input",26),i.NdJ("selectOut",function(e){return t.setTags(e)})("selectIdsOut",function(e){return t.setTagIds(e)}),i.ALo(96,"translate"),i.ALo(97,"translate"),i.ALo(98,"translate"),i.ALo(99,"translate"),i.ALo(100,"translate"),i.ALo(101,"translate"),i.ALo(102,"translate"),i.ALo(103,"translate"),i.ALo(104,"translate"),i.qZA(),i._uU(105,"\n    "),i.TgZ(106,"input",27,28),i.NdJ("ngModelChange",function(e){return t.bookService.model.author_ids=e}),i.qZA(),i._uU(108,"\n    "),i._uU(109,"\n    "),i.TgZ(110,"app-belongs-to-many-input",26),i.NdJ("selectOut",function(e){return t.setAuthors(e)})("selectIdsOut",function(e){return t.setAuthorIds(e)}),i.ALo(111,"translate"),i.ALo(112,"translate"),i.ALo(113,"translate"),i.ALo(114,"translate"),i.ALo(115,"translate"),i.ALo(116,"translate"),i.ALo(117,"translate"),i.ALo(118,"translate"),i.ALo(119,"translate"),i.qZA(),i._uU(120,"\n  "),i.qZA(),i._uU(121,"\n\n  "),i.TgZ(122,"div",29),i._uU(123,"\n    "),i.TgZ(124,"button",30),i.NdJ("click",function(){return t.bookService.save()}),i.TgZ(125,"span",4),i._uU(126,"Save"),i.qZA(),i._uU(127,"\n    "),i.qZA(),i._uU(128,"\n    "),i.TgZ(129,"button",31),i.NdJ("click",function(){return t.bookService.setItem({}),t.booksListComponent.router.navigateByUrl("/admin/books"),t.booksListComponent.sidenav.sidenav.close()}),i.TgZ(130,"span",4),i._uU(131,"Cancel"),i.qZA(),i._uU(132,"\n    "),i.qZA(),i._uU(133,"\n  "),i.qZA(),i._uU(134,"\n\n\n"),i.qZA(),i._uU(135,"\n\n"),i.TgZ(136,"div"),i._uU(137,"\n  "),i.YNc(138,ge,3,3,"pre",32),i._uU(139,"\n"),i.qZA(),i._uU(140,"\n")),2&e){const e=i.MAs(3),n=i.MAs(12);let o,s,a,r;i.xp6(11),i.Q6J("placeholder",i.lcZ(13,70,"Enter")+" "+i.lcZ(14,72,"TITLE"))("ngModel",t.bookService.model.title),i.xp6(5),i.Q6J("ngIf",n.hasError("required")),i.xp6(9),i.Q6J("ngIf",t.bookService.model.cover),i.xp6(2),i.Q6J("name","cover")("id","cover")("placeholder",i.lcZ(29,74,"COVER"))("ngModel",t.bookService.model.cover),i.xp6(4),i.Q6J("name","cover_file")("ngModel",t.files)("disabled",t.disabled)("multiple",!1),i.xp6(13),i.Q6J("name","published_at")("id","published_at")("placeholder",i.lcZ(46,76,"Enter")+" "+i.lcZ(47,78,"PUBLISHED_AT"))("ngModel",t.bookService.model.published_at),i.xp6(12),i.Q6J("placeholder",i.lcZ(58,80,"Enter")+" "+i.lcZ(59,82,"BOUGHT_AT"))("ngModel",t.bookService.model.bought_at),i.xp6(12),i.Q6J("editor",t.editor_resume),i.xp6(2),i.Q6J("name","resume")("id","resume")("editor",t.editor_resume)("ngModel",t.bookService.model.resume)("disabled",!1)("placeholder",i.lcZ(72,84,"Enter")+" "+i.lcZ(73,86,"RESUME")),i.xp6(6),i.Q6J("ngModel",t.bookService.model.genre_id),i.xp6(4),i.Q6J("label",i.lcZ(81,88,"GENRE"))("required",!0)("searchInputLabel",i.lcZ(82,90,"Add")+" "+i.lcZ(83,92,"GENRE"))("searchInputPlaceholder",i.lcZ(84,94,"Search")+" "+i.lcZ(85,96,"GENRE"))("selected",t.bookService.model.genre?t.bookService.model.genre:null)("selectedId",t.bookService.model.genre_id?t.bookService.model.genre_id:null)("searchUrl","api/genres")("searchDisplayColumns",i.DdM(142,he))("searchColumns",i.DdM(143,he))("notFoundUrl","/admin/genres/0")("notFoundButtonText",i.lcZ(86,98,"Create")+" "+i.lcZ(87,100,"GENRE"))("notFoundMessage",i.lcZ(88,102,"No results found for")+" "+i.lcZ(89,104,"GENRE")),i.xp6(11),i.Q6J("ngModel",t.bookService.model.tag_ids)("required",!(null!=t.bookService.model.tag_ids&&t.bookService.model.tag_ids.length)),i.xp6(4),i.Q6J("label",i.lcZ(96,106,"TAGS"))("min",1)("required",!0)("searchInputLabel",i.lcZ(97,108,"Add")+" "+i.lcZ(98,110,"TAG"))("searchInputPlaceholder",i.lcZ(99,112,"Search")+" "+i.lcZ(100,114,"TAG"))("selected",null!==(o=t.bookService.model.tags)&&void 0!==o?o:i.DdM(144,pe))("selectedIds",null!==(s=t.bookService.model.tag_ids)&&void 0!==s?s:i.DdM(145,pe))("searchUrl","api/tags")("searchDisplayColumns",i.DdM(146,he))("searchColumns",i.DdM(147,he))("notFoundUrl","/admin/tags/0")("notFoundButtonText",i.lcZ(101,116,"Create")+" "+i.lcZ(102,118,"TAG"))("notFoundMessage",i.lcZ(103,120,"No results found for")+" "+i.lcZ(104,122,"TAG")),i.xp6(11),i.Q6J("ngModel",t.bookService.model.author_ids)("required",!(null!=t.bookService.model.author_ids&&t.bookService.model.author_ids.length)),i.xp6(4),i.Q6J("label",i.lcZ(111,124,"AUTHORS"))("min",1)("required",!0)("searchInputLabel",i.lcZ(112,126,"Add")+" "+i.lcZ(113,128,"AUTHOR"))("searchInputPlaceholder",i.lcZ(114,130,"Search")+" "+i.lcZ(115,132,"AUTHOR"))("selected",null!==(a=t.bookService.model.authors)&&void 0!==a?a:i.DdM(148,pe))("selectedIds",null!==(r=t.bookService.model.author_ids)&&void 0!==r?r:i.DdM(149,pe))("searchUrl","api/authors")("searchDisplayColumns",i.DdM(150,he))("searchColumns",i.DdM(151,he))("notFoundUrl","/admin/authors/0")("notFoundButtonText",i.lcZ(116,134,"Create")+" "+i.lcZ(117,136,"AUTHOR"))("notFoundMessage",i.lcZ(118,138,"No results found for")+" "+i.lcZ(119,140,"AUTHOR")),i.xp6(14),i.Q6J("disabled",e.invalid),i.xp6(14),i.Q6J("ngIf",!t.environment.production)}},directives:[E._Y,E.JL,E.F,D.KE,D.hX,h.Pi,Y.Nt,E.Fj,E.Q7,E.JJ,E.On,o.O5,Q.xe,D.R9,N.Hw,F.Mn,F.tP,le,ce.l,w.lW,D.TO,D.qo],pipes:[h.X$,o.Ts],styles:[""]}),e})();const be=["sidenav"],_e=function(e){return{marginTop:e}};let fe=(()=>{class e{constructor(e,t,n){this.router=e,this.layoutService=t,this.booksListComponent=n}ngOnInit(){}}return e.\u0275fac=function(t){return new(t||e)(i.Y36(s.F0),i.Y36(m.d),i.Y36(C))},e.\u0275cmp=i.Xpm({type:e,selectors:[["app-books-sidenav"]],viewQuery:function(e,t){if(1&e&&i.Gf(be,5),2&e){let e;i.iGM(e=i.CRH())&&(t.sidenav=e.first)}},decls:25,vars:13,consts:[["mode","over","position","end",2,"width","100%",3,"disableClose"],["sidenav",""],["layout","column","layout-fill",""],[2,"position","fixed"],["mat-icon-button","",3,"click"],["flex","",1,"mat-content",3,"ngStyle"]],template:function(e,t){if(1&e){const e=i.EpF();i.TgZ(0,"mat-sidenav",0,1),i._uU(2,"\n  "),i.TgZ(3,"div",2),i._uU(4,"\n    "),i.TgZ(5,"mat-toolbar",3),i._uU(6,"\n      "),i.TgZ(7,"button",4),i.NdJ("click",function(){i.CHM(e);const n=i.MAs(1);return t.booksListComponent.router.navigateByUrl("/admin/books"),n.close(),t.booksListComponent.bookService.model={id:0}}),i._uU(8,"\n        "),i.TgZ(9,"mat-icon"),i._uU(10,"close"),i.qZA(),i._uU(11,"\n      "),i.qZA(),i._uU(12),i.ALo(13,"translate"),i.ALo(14,"translate"),i.ALo(15,"translate"),i.ALo(16,"translate"),i.qZA(),i._uU(17,"\n    "),i.TgZ(18,"div",5),i._uU(19,"\n      "),i._UZ(20,"app-books-form"),i._uU(21,"\n    "),i.qZA(),i._uU(22,"\n  "),i.qZA(),i._uU(23,"\n"),i.qZA(),i._uU(24,"\n")}2&e&&(i.Q6J("disableClose",!0),i.xp6(12),i.hij("\n      ",t.booksListComponent.bookService.model.id?i.lcZ(13,3,"Edit")+" "+i.lcZ(14,5,"BOOK"):i.lcZ(15,7,"Create")+" "+i.lcZ(16,9,"BOOK"),"\n    "),i.xp6(6),i.Q6J("ngStyle",i.VKq(11,_e,t.layoutService.isMobile?"56px":"64px")))},directives:[J.JX,O.Ye,w.lW,N.Hw,o.PC,B.Zl,me],pipes:[h.X$],styles:[""]}),e})();var Ze=n(71650),Ue=n(46941),ve=n(1769),Ae=n(77746),ke=n(85873),Se=n(67441),xe=n(84742);let Te=(()=>{class e{}return e.\u0275fac=function(t){return new(t||e)},e.\u0275mod=i.oAB({type:e}),e.\u0275inj=i.cJS({imports:[[o.ez,Ze.m8,y]]}),e})();i.B6R(C,[J.TM,fe,o.O5,h.Pi,w.lW,Ue.K_,o.PC,B.Zl,ve.d,l.vn,o.mk,B.oO,E.JJ,E.On,l.Cp,K.X2,$.YI,s.rH,N.Hw,Ae.eA,ke.S,w.zs,Se.gD,o.sg,K.ey],[h.X$,xe.E])}}]);