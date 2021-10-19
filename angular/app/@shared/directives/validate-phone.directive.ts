import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';
import {isPresent} from './lang';
import { isValidNumber } from 'libphonenumber-js';


export const phone = (country: string): ValidatorFn => {
  return (control: AbstractControl): { [key: string]: boolean } | any => {
    if (isPresent(Validators.required(control))) return null;

    let v: string = control.value;

    // @ts-ignore
    return isValidNumber({phone: v, country}) ? null : {phone: true};
  };
};

const PHONE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidatePhoneDirective),
  multi: true
};

@Directive({
  selector: '[phone][formControlName],[phone][formControl],[phone][ngModel]',
  providers: [PHONE_VALIDATOR]
})
export class ValidatePhoneDirective implements Validator, OnInit, OnChanges {
  @Input() phone: string | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = phone(this.phone);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'phone') {
        this.validator = phone(changes[key].currentValue);
        if (this.onChange) this.onChange();
      }
    }
  }

  validate(c: AbstractControl): {[key: string]: any} {
    return this.validator(c);
  }

  registerOnValidatorChange(fn: () => void): void {
    this.onChange = fn;
  }
}
