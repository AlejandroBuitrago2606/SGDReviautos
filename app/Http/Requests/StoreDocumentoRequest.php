<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'idProceso'       => 'required|integer',
            'idTipoDocumento' => 'required|integer',
            'consecutivo'     => 'required|string|max:10',
            'nombreDocumento' => 'required|string|max:60',
            'fechaCreacion'   => 'required|date_format:Y-m-d',
            'fechaVersion'    => 'required|date_format:Y-m-d',
            'numeroVersion'   => 'required|integer', 
            'fechaRevision'   => 'required|date_format:Y-m-d',
            'numeroRevision'  => 'required|integer',
            'v_Actualizada'   => 'sometimes|nullable|integer',
            'numeral'         => 'nullable|string|max:20',
            'observaciones'   => 'nullable|string|max:1500',
            'archivo'         => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:51200',
            
        ];
    }
}
