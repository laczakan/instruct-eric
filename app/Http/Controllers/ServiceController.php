<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // Function to convert csv file to array
    private function getArray()
    {
        // The line turns each line of the csv file into a regular array (ie $item[0], $item[1], etc), so you end up with an array of arrays.
        $csv = array_map('str_getcsv', file(storage_path('app/services.csv')));

        $services = [];

        foreach ($csv as $key => $value) {
            if ($key == 0) {
                $columns = $value;
                continue;
            }
            $services [] = array_combine($columns, $value);
        }
        return $services;
    }

    private function setArray($tmp)
    {
        $csv = array_map('str_getcsv', file(storage_path('app/services.csv')));

        $fp = fopen(storage_path('app/services.csv'), 'w');

        $services = [];

        foreach ($tmp as $key => $value) {
            if ($key == 0) {
                $columns = array_keys($value);

                $services [] = $columns;
            }
            $services [] = array_values($value);
        }

        foreach ($services as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        return $services;
    }

    // Function to show all table (converted to JSON)
    public function index()
    {
        $services = $this->getArray();
        // Return all data as JSON
        return response()->json($services);
    }

    // Function to show specific results
    public function show($countryCode)
    {
        $services = $this->getArray();

        $return = [];

        foreach ($services as $service) {
            // Compare country symbol to country code (in lower letters)
            if (strtolower($service['Country']) == strtolower($countryCode)) {

                $return[] = $service;
            }
        }
        return response($return);
    }

    public function addOrUpdate()
    {
        $services = $this->getArray();
        $exists = false;

        foreach ($services as &$service) {
            // Compare Ref with value from POST
            if ($service["﻿Ref"] == $_POST['Ref']) {
                // If the same Update results: (Centre, Service, Country)
                $exists = true;
                $service['Centre'] = $_POST['Centre'];
                $service['Service'] = $_POST['Service'];
                $service['Country'] = $_POST['Country'];
            }
        }
        // If different Update all results: (Ref, Centre, Service, Country)
        if (!$exists) {
            $services [] = [
                "﻿Ref" => $_POST['Ref'],
                'Centre' => $_POST['Centre'],
                'Service' => $_POST['Service'],
                'Country' => $_POST['Country'],
            ];
        }

        // To update or add to csv file
        $this->setArray($services);

        return response($services);
    }

}
