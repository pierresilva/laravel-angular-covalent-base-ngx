import {Directive, forwardRef, Input, OnChanges, OnInit, SimpleChanges} from '@angular/core';
import {AbstractControl, NG_VALIDATORS, Validator, ValidatorFn, Validators} from '@angular/forms';
import {isPresent} from './lang';

export const max = (max: number): ValidatorFn => {
  return (control: AbstractControl): { [p: string]: any } | null => {
    if (!isPresent(max)) return null;
    if (isPresent(Validators.required(control))) return null;

    let v: number = +control.value;
    return v <= +max ? null : {actualValue: v, requiredValue: +max, max: true};
  };
};

@Directive({
  selector: '[max][formControlName],[max][formControl],[max][ngModel]',
  providers: [
    {
      provide: NG_VALIDATORS,
      useExisting: forwardRef(() => ValidateMaxDirective),
      multi: true
    }
  ]
})
export class ValidateMaxDirective implements Validator, OnInit, OnChanges {

  @Input('max') max: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = max(this.max);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (let key in changes) {
      if (key === 'max') {
        this.validator = max(changes[key].currentValue);
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
