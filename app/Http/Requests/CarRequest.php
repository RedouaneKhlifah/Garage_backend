<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $carId = $this->car ? $this->car->id : null;

        return [
            // Basic information
            'immatriculation' => [
                'required',
                'string',
                'max:20',
                Rule::unique('cars')->ignore($carId)
            ],
            'date_premiere_immatriculation' => 'required|date',
            'client_id' => 'nullable|exists:clients,id',
            'marque_id' => 'required|exists:marques,id',
            'modele_id' => 'required|exists:modeles,id',
            'detail_modele_id' => 'required|exists:detail_modeles,id',
            'version' => 'nullable|string|max:50',
            'energie' => 'required|string|max:100',
            'type_mines' => 'required|string|max:50',
            'genre' => 'required|string|max:50',
            'numero_chassis' => [
                'required',
                'string',
                'max:100',
                Rule::unique('cars')->ignore($carId)
            ],
            'carrosserie' => 'nullable|string|max:100',
            'numero_moteur' => 'nullable|string|max:100',
            'date_prochaine_controle_technique' => 'nullable|date',
            "company_assurance" => 'nullable|string|max:100',

            // JSON field validations
            'autre_information' => 'required|array',
            'autre_information.numero_chassis' => 'required|string',
            'autre_information.type_moteur' => 'required|string',
            'autre_information.numero_cle' => 'nullable|string',
            'autre_information.code_antivol' => 'nullable|string',
            'autre_information.code_gps' => 'nullable|string',
            'autre_information.code_radio' => 'nullable|string',
            'autre_information.numero_carrosserie' => 'nullable|string',
            'autre_information.code_peinture' => 'nullable|string',
            'autre_information.couleur_exterieur' => 'nullable|string',
            'autre_information.couleur_interieur' => 'nullable|string',
            'autre_information.type_peinture' => 'nullable|string',
            'autre_information.type_huile_moteur' => 'nullable|string',
            'autre_information.quantite_huile_moteur' => 'nullable|numeric',

            'controle_technique' => 'required|array',
            'controle_technique.date_prochaine_controle_technique' => 'required|date',

            'certificat_assurance' => 'required|array',
            'certificat_assurance.date_debut' => 'required|date',
            'certificat_assurance.date_fin' => 'required|date|after:certificat_assurance.date_debut',
            'certificat_assurance.identification' => 'required|string',
            'certificat_assurance.numero_contrat' => 'required|string',
            'certificat_assurance.type_contrat' => 'required|string',

            'observations' => 'nullable|string',

            // Tires validation
            'tires' => 'nullable|array|max:4',
            'tires.*.position' => 'required|string|in:avant,arriere',
            'tires.*.season' => 'required|string|in:ete,hiver',
            'tires.*.width' => 'required|integer|max:400',
            'tires.*.aspect_ratio' => 'required|integer|max:80',
            'tires.*.diameter' => 'required|string|max:20',
            'tires.*.indice_vitesse' => 'required|string|max:20',
            'tires.*.charge' => 'required|integer|max:150',
            'tires.*.marque' => 'required|string|max:100',
            'tires.*.modele' => 'required|string|max:100',
            'tires.*.runflat' => 'required|boolean',
            'tires.*.renforce' => 'required|boolean', 
        ];
    }

    public function messages()
    {
        return [
            'immatriculation.unique' => 'This license plate is already registered',
            'numero_chassis.unique' => 'This chassis number is already registered',
            'certificat_assurance.date_fin.after' => 'Insurance end date must be after start date',
            
            // JSON field messages
            'autre_information.required' => 'Additional information is required',
            'autre_information.numero_chassis.required' => 'Chassis number in additional info is required',
            'controle_technique.date_prochaine_controle_technique.required' => 'Next technical control date is required',
            'certificat_assurance.date_debut.required' => 'Insurance start date is required',

            // Tires validation messages
            'tires.*.position.required' => 'Tire position is required',
            'tires.*.season.required' => 'Tire season is required',
            'tires.*.width.required' => 'Tire width is required',
            'tires.*.aspect_ratio.required' => 'Tire aspect ratio is required',
            'tires.*.diameter.required' => 'Tire diameter is required',
            'tires.*.indice_vitesse.required' => 'Tire speed index is required',
            'tires.*.charge.required' => 'Tire load index is required',
            'tires.*.marque.required' => 'Tire brand is required',
            'tires.*.modele.required' => 'Tire model is required',
            'tires.*.runflat.required' => 'Runflat status is required',
            'tires.*.renforce.required' => 'Reinforced status is required',
        ];
    }
}