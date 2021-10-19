import { Directive, Input, forwardRef, OnInit } from '@angular/core';
import { NG_VALIDATORS, Validator, FormControl, ValidatorFn, AbstractControl } from '@angular/forms';

export const equalTo = (equalControl: AbstractControl): ValidatorFn => {
  let subscribe: boolean = false;

  return (control: AbstractControl): null | { equalTo: boolean } => {
    if (!subscribe) {
      subscribe = true;
      equalControl.valueChanges.subscribe(() => {
        control.updateValueAndValidity();
      });
    }

    let v: string = control.value;

    return equalControl.value === v ? null : {equalTo: true};
  };
};

const EQUAL_TO_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateEqualToDirective),
  multi: true
};

@Directive({
  selector: '[equalTo][formControlName],[equalTo][formControl],[equalTo][ngModel]',
  providers: [EQUAL_TO_VALIDATOR]
})
export class ValidateEqualToDirective implements Validator, OnInit {
  @Input() equalTo: FormControl | any;

  private validator: ValidatorFn | any;

  ngOnInit() {
    this.validator = equalTo(this.equalTo);
  }

  validate(c: AbstractControl): {[key: string]: any} {
    return this.validator(c);
  }
}
