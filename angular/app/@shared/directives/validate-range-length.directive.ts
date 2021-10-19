import {Directive, forwardRef, Input, SimpleChanges} from '@angular/core';
import {AbstractControl, NG_VALIDATORS, ValidationErrors, ValidatorFn, Validators} from "@angular/forms";
import {isPresent} from "@shared/directives/lang";

export const rangeLength = (value: Array<number>): ValidatorFn => {
  return (control: AbstractControl): ValidationErrors | null => {
    if (!isPresent(value)) {
      return null;
    }
    if (isPresent(Validators.required(control))) {
      return null;
    }

    const v: string = control.value;
    return v.length >= value[0] && v.length <= value[1] ? null : { rangeLength: { value: value } };
  };
};

const RANGE_LENGTH_VALIDATOR: any = {
  provide: NG_VALIDATORS,
  useExisting: forwardRef(() => ValidateRangeLengthDirective),
  multi: true
};

@Directive({
  selector: '[rangeLength][formControlName],[rangeLength][formControl],[rangeLength][ngModel]',
  providers: [RANGE_LENGTH_VALIDATOR]
})
export class ValidateRangeLengthDirective {

  @Input() rangeLength: [number] | any;

  private validator: ValidatorFn | any;
  private onChange: (() => void) | any;

  ngOnInit() {
    this.validator = rangeLength(this.rangeLength);
  }

  ngOnChanges(changes: SimpleChanges) {
    for (const key in changes) {
      if (key === 'rangeLength') {
        this.validator = rangeLength(changes[key].currentValue);
        if (this.onChange) {
          this.onChange();
        }
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
