import {Directive, forwardRef} from '@angular/core';
import {
  NG_VALIDATORS,
  Validator,
  AbstractControl,
  Validators
} from '@angular/forms';
import {isPresent} from './lang';

@Directive({
  selector: '[url][formControlName],[url][formControl],[url][ngModel]',
  providers: [
    {
      provide: NG_VALIDATORS,
      useExisting: forwardRef(() => ValidateUrlDirective),
      multi: true
    }
  ]
})
export class ValidateUrlDirective implements Validator {

  constructor() { }

  validate(control: AbstractControl): { [key: string]: any } | null {
    if (isPresent(Validators.required(control))) return null;

    let v: string = control.value;
    return /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(v) ? null : {'url': true};
  }


}
