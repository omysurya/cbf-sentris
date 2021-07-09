<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute must be accepted.',
    'active_url'           => ':attribute is not a valid URL.',
    'after'                => ':attribute must be a date after :date.',
    'after_or_equal'       => ':attribute must be a date after or equal to :date.',
    'alpha'                => ':attribute may only contain letters.',
    'alpha_dash'           => ':attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => ':attribute may only contain letters and numbers.',
    'array'                => ':attribute must be an array.',
    'before'               => ':attribute must be a date before :date.',
    'before_or_equal'      => ':attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => ':attribute must be between :min and :max.',
        'file'    => ':attribute must be between :min and :max kilobytes.',
        'string'  => ':attribute must be between :min and :max karakter.',
        'array'   => ':attribute must have between :min and :max items.',
    ],
    'boolean'              => ':attribute field must be true or false.',
    'confirmed'            => ':attribute konfirmasi tidak cocok.',
    'date'                 => ':attribute bukan tanggal yang benar.',
    'date_format'          => ':attribute tidak cocok dengan format :format.',
    'different'            => ':attribute and :other must be different.',
    'digits'               => ':attribute must be :digits digits.',
    'digits_between'       => ':attribute must be between :min and :max digits.',
    'dimensions'           => ':attribute has invalid image dimensions.',
    'distinct'             => ':attribute field has a duplicate value.',
    'email'                => ':attribute harus diisi email yang benar',
    'exists'               => ':attribute yang anda masukan tidak ada',
    'file'                 => ':attribute harus file.',
    'filled'               => ':attribute field must have a value.',
    'image'                => ':attribute harus sebuah gambar.',
    'in'                   => 'selected :attribute is invalid.',
    'in_array'             => ':attribute field does not exist in :other.',
    'integer'              => ':attribute harus sebuah angka bulat.',
    'ip'                   => ':attribute must be a valid IP address.',
    'json'                 => ':attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'file'    => ':attribute tidak boleh lebih dari :max kilobytes.',
        'string'  => ':attribute tidak boleh lebih dari :max karakter.',
        'array'   => ':attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute harus berformat file: :values.',
    'mimetypes'            => ':attribute harus berformat file: :values.',
    'min'                  => [
        'numeric' => ':attribute harus minimal :min.',
        'file'    => ':attribute harus minimal :min kilobytes.',
        'string'  => ':attribute harus minimal :min karakter.',
        'array'   => ':attribute must have at least :min items.',
    ], 
    'not_in'               => 'selected :attribute is invalid.',
    'numeric'              => ':attribute harus sebuah angka.',
    'present'              => ':attribute field must be present.',
    'regex'                => ':attribute format is invalid.',
    'required'             => ':attribute harus diisi.',
    'required_if'          => ':attribute field is required when :other is :value.',
    'required_unless'      => ':attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute field is required when :values is present.',
    'required_with_all'    => ':attribute field is required when :values is present.',
    'required_without'     => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same'                 => ':attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute must be :size.',
        'file'    => ':attribute harus berukuran :size kilobytes.',
        'string'  => ':attribute must be :size karakter.',
        'array'   => ':attribute must contain :size items.',
    ],
    'string'               => ':attribute harus berupa string.',
    'timezone'             => ':attribute must be a valid zone.',
    'unique'               => ':attribute sudah ada dalam database.',
    'uploaded'             => ':attribute gagal di upload.',
    'url'                  => ':attribute format salah.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
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
    | following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
