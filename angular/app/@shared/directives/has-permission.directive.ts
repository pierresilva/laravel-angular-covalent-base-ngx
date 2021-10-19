import {Directive, ElementRef, Input, Renderer2} from '@angular/core';
import {AuthService} from '@shared';

@Directive({
  selector: '[hasPermission]'
})
export class HasPermissionDirective {

  @Input() set hasPermission(permissions: string[]) {
    this.setHidden(permissions);
  }

  constructor(
    private auth: AuthService,
    private renderer: Renderer2,
    private hostElement: ElementRef,
  ) {

  }

  setHidden(permissions:string[]) {
    if (!this.auth.hasPermission(permissions)) {
      this.renderer.addClass(this.hostElement.nativeElement, '_hidden');
    }
  }

}
