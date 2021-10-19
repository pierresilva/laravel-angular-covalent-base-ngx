import {Directive, forwardRef, Input, OnChanges, OnInit, SimpleChanges} from '@angular/core';
import {AbstractControl, NG_VALIDATORS, ValidationErrors, Validator, ValidatorFn, Validators} from "@angular/forms";
import {isPresent} from "@shared/directives/lang";

export const gte = (value: number): ValidatorFn => {
  return (control: AbstractControl): ValidationErrors | null => {
    if (!isPresent(value)) {
      return null;
    }
    if (isPresent(Validators.required(control))) {
      return null;
    }

    const v: number = +control.value;
    return v >= +value ? null : { gte: { value: value } };
  };
};

const GREATER_THAN_EQUAL_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateGreaterThanEqualDirective),
  multi: true
};

@Directive({
  selector: '[gte][formControlName],[gte][formControl],[gte][ngModel]',
  providers: [GREATER_THAN_EQUAL_VALIDATOR]
})
export class ValidateGreaterThanEqualDirective implements Validator, OnInit, OnChanges {

  @Input() gte: number | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = gte(this.gte);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (const key in changes) {
      if (key === 'gte') {
        this.validator = gte(changes[key].currentValue);
        if (this.onChange) {
          this.onChange();
        }
      }
    }
  }

  validate(c: AbstractControl): {[key: string]: any} | any {
    return this.validator(c);
  }

  registerOnValidatorChange(fn: () => void): void {
    this.onChange = fn;
  }

}
