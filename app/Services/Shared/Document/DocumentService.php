<?php

namespace App\Services\Shared\Document;

use App\Models\Document;

class DocumentService
{
  
    public function getAll()
    {
        return Document::all();
    }

    public function getById($id)
    {
        return Document::find($id);
    }

    public function getByUserId($user_id){
        return Document::where('user_id', $user_id)->first();
    }

    public function create($data)
    {
        $physical_office = [];
        $reference_details = [];
        $previous_client_details = [];
        $client_review_links = [];
        if(isset($data['social_score'])){
            $data['social_score'] =  json_encode($data['social_score']);
        }
        if(isset($data['physical_office'])){
            if(isset($data['physical_office']['city'])){
                $physical_office_array = $data['physical_office']['city'];
                $building = $data['physical_office']['building'];
                $address1 = $data['physical_office']['address1'];
                $address2 = $data['physical_office']['address2'];
                $province = $data['physical_office']['province'];
                $zip_code = $data['physical_office']['zip_code'];
                foreach($physical_office_array as $key => $po){
                    $form_data = array(
                        'building' => $building[$key],
                        'address1' => $address1[$key],
                        'address2' => $address2[$key],
                        'province' => $province[$key],
                        'zip_code' => $zip_code[$key],
                        'city' => $po,

                    );
                    array_push($physical_office, $form_data);
                }
            }
        }
        if(count($physical_office) > 0){
            $data['physical_office'] =  json_encode($physical_office);
        }
        if(isset($data['reference_details'])){
            if(isset($data['reference_details']['name'])){
                $reference_details_array = $data['reference_details']['name'];
                $company = $data['reference_details']['company'];
                $email = $data['reference_details']['email'];
                $phone = $data['reference_details']['phone'];
                foreach($reference_details_array as $key => $rd){
                    $form_data = array(
                        'company' => $company[$key],
                        'email'   => $email[$key],
                        'phone'   => $phone[$key],
                        'name'    => $rd,

                    );
                    array_push($reference_details, $form_data);
                }
            }
        }
        if(count($reference_details) > 0){
            $data['reference_details'] =  json_encode($reference_details);
        }

        if(isset($data['previous_client_details'])){
            if(isset($data['previous_client_details']['name'])){
                $previous_client_details_array = $data['previous_client_details']['name'];
                $contact = $data['previous_client_details']['contact'];
                foreach($previous_client_details_array as $key => $pc){
                    $form_data = array(
                        'contact' => $contact[$key],
                        'name'    => $pc,

                    );
                    array_push($previous_client_details, $form_data);
                }
            }
        }

        if(count($previous_client_details) > 0){
            $data['previous_client_details'] =  json_encode($previous_client_details);
        }

        $client_review_links = array('google_review_link' => null, 'trustpilot_link' => null);

        if (isset($data['google_review_link']) AND ! empty($data['google_review_link']) AND ! isset($data['trustpilot_link'])) {
            $client_review_links = array('google_review_link' => $data['google_review_link'], 'trustpilot_link' => null);
        }

        if (isset($data['trustpilot_link']) AND !empty($data['trustpilot_link']) AND !isset($data['google_review_link'])) {
             $client_review_links = array('google_review_link' => null, 'trustpilot_link' => $data['google_review_link']);
        }

        if (isset($data['trustpilot_link']) AND isset($data['google_review_link']) AND !empty($data['trustpilot_link']) AND !empty($data['google_review_link'])) {
             $client_review_links = array('google_review_link' =>  $data['google_review_link'], 'trustpilot_link' => $data['google_review_link']);
        }

        if(count($client_review_links) > 0){
            $data['client_review_links'] =  json_encode($client_review_links);
        }
        
        return Document::create($data);
    }

    public function update($id, $data)
    {
        $physical_office = [];
        $reference_details = [];
        $previous_client_details = [];
        $client_review_links = [];
        if(isset($data['social_score'])){
            $data['social_score'] =  json_encode($data['social_score']);
        }
        if(isset($data['physical_office'])){
            if(isset($data['physical_office']['city'])){
                $physical_office_array = $data['physical_office']['city'];
                $building = $data['physical_office']['building'];
                $address1 = $data['physical_office']['address1'];
                $address2 = $data['physical_office']['address2'];
                $province = $data['physical_office']['province'];
                $zip_code = $data['physical_office']['zip_code'];
                foreach($physical_office_array as $key => $po){
                    $form_data = array(
                        'building' => $building[$key],
                        'address1' => $address1[$key],
                        'address2' => $address2[$key],
                        'province' => $province[$key],
                        'zip_code' => $zip_code[$key],
                        'city' => $po,

                    );
                    array_push($physical_office, $form_data);
                }
            }
        }
        if(count($physical_office) > 0){
            $data['physical_office'] =  json_encode($physical_office);
        }
        if(isset($data['reference_details'])){
            if(isset($data['reference_details']['name'])){
                $reference_details_array = $data['reference_details']['name'];
                $company = $data['reference_details']['company'];
                $email = $data['reference_details']['email'];
                $phone = $data['reference_details']['phone'];
                foreach($reference_details_array as $key => $rd){
                    $form_data = array(
                        'company' => $company[$key],
                        'email'   => $email[$key],
                        'phone'   => $phone[$key],
                        'name'    => $rd,

                    );
                    array_push($reference_details, $form_data);
                }
            }
        }
        if(count($reference_details) > 0){
            $data['reference_details'] =  json_encode($reference_details);
        }

        if(isset($data['previous_client_details'])){
            if(isset($data['previous_client_details']['name'])){
                $previous_client_details_array = $data['previous_client_details']['name'];
                $contact = $data['previous_client_details']['contact'];
                foreach($previous_client_details_array as $key => $pc){
                    $form_data = array(
                        'contact' => $contact[$key],
                        'name'    => $pc,

                    );
                    array_push($previous_client_details, $form_data);
                }
            }
        }

        if(count($previous_client_details) > 0){
            $data['previous_client_details'] =  json_encode($previous_client_details);
        }

        $client_review_links = array('google_review_link' => null, 'trustpilot_link' => null);

        if (isset($data['google_review_link']) AND ! empty($data['google_review_link']) AND ! isset($data['trustpilot_link'])) {
            $client_review_links = array('google_review_link' => $data['google_review_link'], 'trustpilot_link' => null);
        }

        if (isset($data['trustpilot_link']) AND !empty($data['trustpilot_link']) AND !isset($data['google_review_link'])) {
             $client_review_links = array('google_review_link' => null, 'trustpilot_link' => $data['google_review_link']);
        }

        if (isset($data['trustpilot_link']) AND isset($data['google_review_link']) AND !empty($data['trustpilot_link']) AND !empty($data['google_review_link'])) {
             $client_review_links = array('google_review_link' =>  $data['google_review_link'], 'trustpilot_link' => $data['google_review_link']);
        }

        if(count($client_review_links) > 0){
            $data['client_review_links'] =  json_encode($client_review_links);
        }
        
        $document = $this->getById($id);
        $document->update($data);
        return  $document;
    }

    public function updateSimple($id, $data){
        $document = $this->getById($id);
        $document->update($data);
        return  $document;
    }

    public function delete($id)
    {
        $document = $this->getById($id);
        return $document->delete();
    }
}
