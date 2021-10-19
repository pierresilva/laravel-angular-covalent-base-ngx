import {Directive, ElementRef, Input, Renderer2} from '@angular/core';
import {AuthService} from '@shared';

@Directive({
  selector: '[hasRole]'
})
export class HasRoleDirective {

  @Input() set hasRole(roles: string[]) {
    this.setHidden(roles);
  }

  constructor(
    private auth: AuthService,
    private renderer: Renderer2,
    private hostElement: ElementRef,
  ) {

  }

  setHidden(roles:string[]) {
    if (!this.auth.hasRole(roles)) {
      this.renderer.addClass(this.hostElement.nativeElement, '_hidden');
    }
  }

}
