<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'ال  يجب قبوله.',
    'active_url'           => 'ال  ليس عنوان URL صالحًا.',
    'after'                => 'ال  يجب أن يكون تاريخ بعد :date.',
    'alpha'                => 'ال  قد تحتوي على أحرف فقط.',
    'alpha_dash'           => 'ال  قد تحتوي فقط على أحرف وأرقام وشرطات.',
    'alpha_num'            => 'ال  قد يحتوي فقط على أحرف وأرقام.',
    'array'                => 'ال :attribute must be an array.',
    'before'               => 'ال :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'ال  يجب أن يكون عنوان بريد إلكتروني صالح.',
    'exists'               => 'المختار  غير صالح.',
    'filled'               => 'ال :attribute الحقل مطلوب.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'ال  قد لا يكون أكبر من :max.',
        'file'    => 'ال  قد لا يكون أكبر من :max kilobytes.',
        'string'  => 'ال  قد لا يكون أكبر من :max حروف.',
        'array'   => 'ال  قد لا يكون أكثر من :max العناصر.',
    ],
    'mimes'                => 'ال  يجب أن يكون ملف من النوع: :values.',
    'min'                  => [
        'numeric' => 'ال  لا بد أن يكون على الأقل :min.',
        'file'    => 'ال  لا بد أن يكون على الأقل :min kilobytes.',
        'string'  => 'ال  لا بد أن يكون على الأقل :min حروف.',
        'array'   => 'ال  لا بد أن يكون على الأقل  :min العناصر.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'ال :attribute يجب أن تكون حروف.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'هذه البيانات متواجدا سابقا .',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
