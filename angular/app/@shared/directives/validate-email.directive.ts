import {Directive, forwardRef} from '@angular/core';
import {
  NG_VALIDATORS,
  Validator,
  AbstractControl,
  Validators
} from '@angular/forms';
import {isPresent} from './lang';

@Directive({
  selector: '[email][formControlName],[email][formControl],[email][ngModel]',
  providers: [
    {
      provide: NG_VALIDATORS,
      useExisting: forwardRef(() => ValidateEmailDirective),
      multi: true
    }
  ]
})
export class ValidateEmailDirective implements Validator {

  constructor() {
  }

  validate(control: AbstractControl): { [key: string]: any } | null {
    if (isPresent(Validators.required(control))) return null;

    let v: string = control.value;
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ? null : {'email': true};
  }

}
