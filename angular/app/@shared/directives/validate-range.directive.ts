import { Directive, Input, forwardRef, OnInit, OnChanges, SimpleChanges } from '@angular/core';
import {NG_VALIDATORS, Validator, ValidatorFn, AbstractControl, Validators} from '@angular/forms';

import { isPresent } from './lang';

export const range = (range: Array<number>): ValidatorFn => {
  return (control: AbstractControl): {[key: string]: any} | any => {
    if (!isPresent(range)) return null;
    if (isPresent(Validators.required(control))) return null;

    let v: number = +control.value;
    return v >= range[0] && v <= range[1] ? null : {actualValue: v, requiredValue: range, range: true};
  };
};

const RANGE_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateRangeDirective),
  multi: true
};

@Directive({
  selector: '[range][formControlName],[range][formControl],[range][ngModel]',
  providers: [RANGE_VALIDATOR]
})
export class ValidateRangeDirective implements Validator, OnInit, OnChanges {
  @Input() range: [number] | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = range(this.range);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'range') {
        this.validator = range(changes[key].currentValue);
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
