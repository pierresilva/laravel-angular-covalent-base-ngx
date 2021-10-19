import { Directive, Input, forwardRef, OnInit } from '@angular/core';
import { NG_VALIDATORS, Validator, FormControl, ValidatorFn, AbstractControl } from '@angular/forms';

export const notEqualTo = (notEqualControl: AbstractControl): ValidatorFn => {
  let subscribe: boolean = false;
  return (control: AbstractControl): null | { notEqualTo: boolean } => {
    if (!subscribe) {
      subscribe = true;
      notEqualControl.valueChanges.subscribe(() => {
        control.updateValueAndValidity();
      });
    }

    let v: string = control.value;

    return notEqualControl.value !== v ? null : {notEqualTo: true};
  };
};

const NOT_EQUAL_TO_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateNotEqualToDirective),
  multi: true
};

@Directive({
  selector: '[notEqualTo][formControlName],[notEqualTo][formControl],[notEqualTo][ngModel]',
  providers: [NOT_EQUAL_TO_VALIDATOR]
})
export class ValidateNotEqualToDirective implements Validator, OnInit {
  @Input() notEqualTo: FormControl | any;

  private validator: ValidatorFn | any;

  ngOnInit() {
    this.validator = notEqualTo(this.notEqualTo);
  }

  validate(c: AbstractControl): {[key: string]: any} {
    return this.validator(c);
  }
}
