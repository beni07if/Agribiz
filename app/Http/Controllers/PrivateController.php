<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Consolidation;
use App\Models\CompanyOwnership;
use App\Models\CompanyOwnershipSecond;
use App\Models\Subsidiary;
use App\Models\Group;
use App\Models\Message;
use App\Models\Chatbot;
use App\Models\User;
use App\Models\Landingpage;
use App\Models\Faq;
use App\Models\Sra;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;

class PrivateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function group2Show(Request $request)
    {

        $consol = Group::all();
        $coordinates = null; // Initialize coordinates variable
        $users = User::all();
        $consul = User::all();
        $subsidiaryName = $request->input('group_name');

        $input = $request->input('group_name'); // ambil input pesan dari userssss
        $subsidiaries = Group::where('group_name', 'like', '%' . $input . '%')->get(); // cari data subsidiary yang cocok dengan input

        // $distinctSubsidiary = Consolidation::where('subsidiary', $subsidiaryName)
        //     ->distinct('subsidiary')
        //     ->pluck('subsidiary');

        if ($subsidiaryName) {
            // Fetch the coordinate data from the database based on the subsidiary
            // $coordinates = DB::table('groups')->select('latitude', 'longitude')->where('subsidiary', $subsidiaryName)->first();
            $coordinates = DB::table('groups')->select('group_name', 'group_status', 'controller', 'country_registration', 'management_name_and_position')->where('group_name', $subsidiaryName)->get();
        }
        // return view('maps', compact('coordinates', 'consol', 'subsidiary'));

        $groups = DB::table('groups')
            ->where('group_name', $subsidiaryName)
            ->get();

        // foreach ($groups as $subs) {
        //     $number = intval($subs->sizebyeq);
        //     $formattedNumber = number_format($number);

        //     if ($number) {
        //         $subs->sizebyeq = $formattedNumber;
        //     } else {
        //         $subs->sizebyeq = '-';
        //     }
        // }

        // $regencies0 = [];
        // $provinces0 = [];
        // $countries0 = [];
        // $subsidiary0 = [];

        // foreach ($subsidiaries as $sub0) {
        //     if (!in_array($sub0->regency, $regencies0)) {
        //         $regencies0[] = $sub0->regency;
        //     }

        //     if (!in_array($sub0->province, $provinces0)) {
        //         $provinces0[] = $sub0->province;
        //     }

        //     if (!in_array($sub0->country_operation, $countries0)) {
        //         $countries0[] = $sub0->country_operation;
        //     }

        //     if (!in_array($sub0->subsidiary, $subsidiary0)) {
        //         $subsidiary0[] = $sub0->subsidiary;
        //     }
        // }

        // if ($subsidiaries->isNotEmpty()) {
        //     $subsidiary = $subsidiaries->first();
        //     $shareholders = explode(',', $subsidiary->shareholder_subsidiary);
        //     $shareholder_data = [];
        //     $total_share = 0;

        //     if (is_array($shareholders)) {
        //         foreach ($shareholders as $shareholder) {
        //             $share_info = explode('(', $shareholder);
        //             $shareholder_name = trim($share_info[0]);

        //             if (isset($share_info[1])) {
        //                 $share_percentage = str_replace(['%', ')'], '', $share_info[1]);
        //                 $total_share += $share_percentage;
        //                 $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => $share_percentage];
        //             } else {
        //                 $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => null];
        //             }
        //         }
        //     } else {
        //         $share_info = explode('(', $shareholders);
        //         $shareholder_name = trim($share_info[0]);

        //         if (isset($share_info[1])) {
        //             $share_percentage = str_replace(['%', ')'], '', $share_info[1]);
        //             $total_share += $share_percentage;
        //             $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => $share_percentage];
        //         } else {
        //             $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => null];
        //         }
        //     }

        //     usort($shareholder_data, function ($a, $b) {
        //         return $b['share_percentage'] <=> $a['share_percentage'];
        //     });

        //     $majority_shareholder = $shareholder_data[0]['name'];
        //     $majority_share_percentage = $shareholder_data[0]['share_percentage'];

        //     if ($subsidiary->group_type == 'Independent') {
        //         $group_narrative = 'is a company controlled by';
        //         $group_narrative2 = '';
        //     } else if ($subsidiary->group_type == 'Coop') {
        //         $group_narrative = 'is a cooperative controlled by';
        //         $group_narrative2 = '';
        //     } else {
        //         $group_narrative = 'is a subsidiary of the ';
        //         $group_narrative2 = ' group';
        //     }

        //     // narasi shareholder v1 with no link
        //     if (count($shareholder_data) > 1) {
        //         if ($total_share > 50) {
        //             $response = $subsidiary->group_name . ' is a group of companies operating in ' . $subsidiary->country_operation . ' and engaged in ' . $subsidiary->principal_activities . '.';
        //         } else {
        //             $response = $subsidiary->group_name . ' is a group companies operating in ' . $subsidiary->country_operation . ' and engaged in ' . $subsidiary->principal_activities . '.';
        //         }
        //     } else {
        //         // $response = $subsidiary->group_name . ' ' . $group_narrative . ' ' . $subsidiary->group_name . ' located at ' . $subsidiary->principal_activities . '.' . 'Mayoritas kepemilikan sahamnya dimiliki oleh <a href="' . route('shareholder', ['name' => $majority_shareholder]) . '">' . $majority_shareholder . '</a> sebesar ' . $majority_share_percentage . '%. ';
        //         $response = $subsidiary->group_name . ' is a group companies operating in ' . $subsidiary->country_operation . ' and engaged in ' . $subsidiary->principal_activities . '.';
        //     }

        //     if (count($shareholder_data) > 0) {
        //         $perusahaan = implode(' and ', $subsidiaries->pluck('group_name')->unique()->toArray());
        //     } else {
        //         $perusahaan = '';
        //     }

        //     // end narasi shareholder v1 with no link
        // } else {
        //     $response = 'Subsidiary not found..';
        // }

        // $subsidiary = response()->json(['message' => $response]);
        // $subsidiary = $response;
        // return $subsidiary;
        // return view('content.en.test', compact('groups'));



        $consol0 = Consolidation::all();
        $coordinates0 = null; // Initialize coordinates variable
        $users0 = User::all();
        $consul0 = User::all();
        $subsidiaryName = $request->input('group_name');

        $input = $request->input('group_name'); // ambil input pesan dari userssss
        $subsidiaries = Consolidation::where('group_name', 'like', '%' . $input . '%')->get(); // cari data subsidiary yang cocok dengan input

        // $distinctSubsidiary = Consolidation::where('subsidiary', $subsidiaryName)
        //     ->distinct('subsidiary')
        //     ->pluck('subsidiary');

        if ($subsidiaryName) {
            // Fetch the coordinate data from the database based on the subsidiary
            // $coordinates = DB::table('consolidations')->select('latitude', 'longitude')->where('subsidiary', $subsidiaryName)->first();
            $coordinates = DB::table('consolidations')->select('latitude', 'longitude', 'subsidiary', 'country_operation', 'province', 'regency', 'facilities', 'capacity', 'sizebyeq', 'estate', 'group_name', 'principal_activities')->where('group_name', $subsidiaryName)->get();
        }
        // return view('maps', compact('coordinates', 'consol', 'subsidiary'));

        $consolidations = DB::table('consolidations')
            ->where('group_name', $subsidiaryName)
            ->get();

        foreach ($consolidations as $subs) {
            $number = intval($subs->sizebyeq);
            $formattedNumber = number_format($number);

            if ($number) {
                $subs->sizebyeq = $formattedNumber;
            } else {
                $subs->sizebyeq = '-';
            }
        }

        $regencies0 = [];
        $provinces0 = [];
        $countries0 = [];
        $subsidiary0 = [];

        foreach ($subsidiaries as $sub0) {
            if (!in_array($sub0->regency, $regencies0)) {
                $regencies0[] = $sub0->regency;
            }

            if (!in_array($sub0->province, $provinces0)) {
                $provinces0[] = $sub0->province;
            }

            if (!in_array($sub0->country_operation, $countries0)) {
                $countries0[] = $sub0->country_operation;
            }

            if (!in_array($sub0->subsidiary, $subsidiary0)) {
                $subsidiary0[] = $sub0->subsidiary;
            }
        }

        // // jangan dihapus, kalo ini diaktifkan maka ada beberpa group yang error pagenya, perlu di cek
        // if ($subsidiaries->isNotEmpty()) {
        //     $subsidiary = $subsidiaries->first();
        //     $shareholders = explode(',', $subsidiary->shareholder_subsidiary);
        //     $shareholder_data = [];
        //     $total_share = 0;

        //     if (is_array($shareholders)) {
        //         foreach ($shareholders as $shareholder) {
        //             $share_info = explode('(', $shareholder);
        //             $shareholder_name = trim($share_info[0]);

        //             if (isset($share_info[1])) {
        //                 $share_percentage = str_replace(['%', ')'], '', $share_info[1]);
        //                 $total_share += $share_percentage;
        //                 $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => $share_percentage];
        //             } else {
        //                 $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => null];
        //             }
        //         }
        //     } else {
        //         $share_info = explode('(', $shareholders);
        //         $shareholder_name = trim($share_info[0]);

        //         if (isset($share_info[1])) {
        //             $share_percentage = str_replace(['%', ')'], '', $share_info[1]);
        //             $total_share += $share_percentage;
        //             $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => $share_percentage];
        //         } else {
        //             $shareholder_data[] = ['name' => $shareholder_name, 'share_percentage' => null];
        //         }
        //     }

        //     usort($shareholder_data, function ($a, $b) {
        //         return $b['share_percentage'] <=> $a['share_percentage'];
        //     });

        //     $majority_shareholder = $shareholder_data[0]['name'];
        //     $majority_share_percentage = $shareholder_data[0]['share_percentage'];

        //     if ($subsidiary->group_type == 'Independent') {
        //         $group_narrative = 'is a company controlled by';
        //         $group_narrative2 = '';
        //     } else if ($subsidiary->group_type == 'Coop') {
        //         $group_narrative = 'is a cooperative controlled by';
        //         $group_narrative2 = '';
        //     } else {
        //         $group_narrative = 'is a subsidiary of the ';
        //         $group_narrative2 = ' group';
        //     }

        //     // narasi shareholder v1 with no link
        //     if (count($shareholder_data) > 1) {
        //         if ($total_share > 50) {
        //             $response = $subsidiary->group_name . ' is a group of companies operating in ' . $subsidiary->country_operation . ' and engaged in ' . $subsidiary->principal_activities . '.';
        //         } else {
        //             $response = $subsidiary->group_name . ' is a group companies operating in ' . $subsidiary->country_operation . ' and engaged in ' . $subsidiary->principal_activities . '.';
        //         }
        //     } else {
        //         // $response = $subsidiary->group_name . ' ' . $group_narrative . ' ' . $subsidiary->group_name . ' located at ' . $subsidiary->principal_activities . '.' . 'Mayoritas kepemilikan sahamnya dimiliki oleh <a href="' . route('shareholder', ['name' => $majority_shareholder]) . '">' . $majority_shareholder . '</a> sebesar ' . $majority_share_percentage . '%. ';
        //         $response = $subsidiary->group_name . ' is a group companies operating in ' . $subsidiary->country_operation . ' and engaged in ' . $subsidiary->principal_activities . '.';
        //     }

        //     if (count($shareholder_data) > 0) {
        //         $perusahaan = implode(' and ', $subsidiaries->pluck('group_name')->unique()->toArray());
        //     } else {
        //         $perusahaan = '';
        //     }

        //     // end narasi shareholder v1 with no link
        // } else {
        //     $response = 'Subsidiary not found..';
        // }

        // // $subsidiary = response()->json(['message' => $response]);
        // $subsidiary = $response;
        // // end jangan dihapus

        // return $subsidiary;
        // return view('content.en.test', compact('consolidations'));
        // return view('content.en.indexGroup', compact('consolidations', 'perusahaan', 'subsidiary', 'users0', 'consul0', 'consol0', 'coordinates0'));
        
        return view('webview.overviewGroup', compact('groups', 'users', 'consul', 'consol', 'consolidations', 'coordinates', 'users0', 'consul0', 'consol0', 'coordinates0'));
        // return view('maps', compact('coordinates', 'consol', 'subsidiary'));
        // end versi chat 
    }


    public function subsidiaryShow(Request $request)
{
    $consol = Consolidation::all();
    $coordinates = null;
    $users = User::all();
    $consul = User::all();
    $subsidiaryName = $request->input('subsidiary');

    if ($subsidiaryName) {
        $coordinates = DB::table('consolidations')
            ->select(
                'latitude',
                'longitude',
                'subsidiary',
                'country_operation',
                'province',
                'regency',
                'facilities',
                'capacity',
                'sizebyeq',
                'estate',
                'group_name',
                'principal_activities'
            )
            ->where('subsidiary', $subsidiaryName)
            ->get();
    }

    $consolidations = DB::table('consolidations')
        ->where('subsidiary', $subsidiaryName)
        ->get();

    $companyOwnership = DB::table('company_ownerships')
        ->where('company_name', $subsidiaryName)
        ->union(
            DB::table('company_ownership_seconds')
                ->where('company_name', $subsidiaryName)
        )
        ->get();

    foreach ($consolidations as $subs) {
        $number = intval($subs->sizebyeq);
        $subs->sizebyeq = $number ? number_format($number) : '-';
    }

    $input = $request->input('subsidiary');
    $subsidiaries = Consolidation::where('subsidiary', 'like', "%{$input}%")->get();

    $regencies0 = [];
    $provinces0 = [];
    $countries0 = [];

    foreach ($subsidiaries as $sub0) {
        if (!in_array($sub0->regency, $regencies0)) {
            $regencies0[] = $sub0->regency;
        }
        if (!in_array($sub0->province, $provinces0)) {
            $provinces0[] = $sub0->province;
        }
        if (!in_array($sub0->country_operation, $countries0)) {
            $countries0[] = $sub0->country_operation;
        }
    }

    if ($subsidiaries->isNotEmpty()) {
        $subsidiary = $subsidiaries->first();
        $shareholders = explode(',', $subsidiary->shareholder_subsidiary);
        $shareholder_data = [];
        $total_share = 0;

        foreach ($shareholders as $shareholder) {
            $share_info = explode('(', $shareholder);
            $shareholder_name = trim($share_info[0]);

            if (isset($share_info[1])) {
                $share_percentage = str_replace(['%', ')'], '', $share_info[1]);
                $total_share += $share_percentage;
                $shareholder_data[] = [
                    'name' => $shareholder_name,
                    'share_percentage' => $share_percentage,
                ];
            } else {
                $shareholder_data[] = [
                    'name' => $shareholder_name,
                    'share_percentage' => null,
                ];
            }
        }

        $response = '';

        if (auth()->check() && ($user_level = auth()->user()->user_level)) {
            if ($user_level === 'Premium') {
                if (count($shareholder_data) > 1) {
                    if ($total_share > 50) {
                        $response =
                            $subsidiary->subsidiary .
                            ' is a company engaged in the field of oil palm plantations located in ' .
                            implode(', ', $regencies0) .
                            ', ' .
                            implode(', ', $countries0) .
                            '. The majority of its shares are owned by ' .
                            $shareholder_data[0]['name'] .
                            ' ' .
                            $shareholder_data[0]['share_percentage'] .
                            '% and the rest are owned by ' .
                            implode(
                                ', ',
                                array_map(function ($data) {
                                    return $data['name'] . ' ' . $data['share_percentage'] . '%';
                                }, array_slice($shareholder_data, 1))
                            ) .
                            '. ';
                    } else {
                        $response =
                            $subsidiary->subsidiary .
                            ' is a company engaged in the field of oil palm plantations located in ' .
                            implode(', ', $regencies0) .
                            ', ' .
                            implode(', ', $countries0) .
                            '. Its share ownership is distributed among several shareholders, viz ' .
                            implode(
                                ', ',
                                array_map(function ($data) {
                                    return $data['name'] . ' ' . $data['share_percentage'] . '%';
                                }, $shareholder_data)
                            ) .
                            '. ';
                    }
                } else {
                    $response =
                        $subsidiary->subsidiary .
                        ' is a company engaged in the field of oil palm plantations located in ' .
                        implode(', ', $regencies0) .
                        ', ' .
                        implode(', ', $countries0) .
                        '. Share ownership is owned by ' .
                        implode(
                            ', ',
                            array_map(function ($data) {
                                return $data['name'] . ' ' . $data['share_percentage'] . '%';
                            }, $shareholder_data)
                        ) .
                        '. ';
                }
            } else {
                $response =
                    $subsidiary->subsidiary .
                    ' is a company engaged in the field of oil palm plantations located in ' .
                    implode(', ', $regencies0) .
                    ', ' .
                    implode(', ', $countries0) .
                    '. ';
            }
        }
    } else {
        $response = 'Subsidiary not found..';
    }

    $subsidiari = $response;

    return view('webview.overviewSubsidiary', compact(
        'companyOwnership',
        'consolidations',
        'subsidiari',
        'users',
        'consul',
        'consol',
        'coordinates'
    ));
}


    public function shareholderShow(Request $request)
    {
        // Get the 'shareholder_name' and 'date_of_birth' from the request
        $name = $request->input('shareholder_name');
        $dob = $request->input('date_of_birth');

        // Retrieve shareholder details from CompanyOwnership
        $shareholderNames = CompanyOwnership::select(
                'shareholder_name', 
                'date_of_birth', 
                'ic_passport_comp_number', 
                'address', 
                'position', 
                'number_of_shares', 
                'total_of_shares', 
                'percentage_of_shares', 
                'currency', 
                'company_name', 
                'data_source',
                'data_update'
            )
            ->where('shareholder_name', $name) // Match the shareholder name
            ->where('date_of_birth', $dob); // Match the date of birth

        // Retrieve shareholder details from CompanyOwnershipSecond
        $shareholderNamesSecond = CompanyOwnershipSecond::select(
                'shareholder_name', 
                'date_of_birth', 
                'ic_passport_comp_number', 
                'address', 
                'position', 
                'number_of_shares', 
                'total_of_shares', 
                'percentage_of_shares', 
                'currency', 
                'company_name', 
                'data_source',
                'data_update'
            )
            ->where('shareholder_name', $name) // Match the shareholder name
            ->where('date_of_birth', $dob); // Match the date of birth

        // Combine both queries using UNION and paginate the results
        $allShareholderNames = $shareholderNames
            ->union($shareholderNamesSecond)
            ->paginate(10); // Paginate the combined results

        // Append the 'shareholder_name' and 'date_of_birth' to the pagination links
        $allShareholderNames->appends(['shareholder_name' => $name, 'date_of_birth' => $dob]);

        // Return the view with the paginated results
        return view('webview.overviewShareholder', compact('allShareholderNames'));
    }

public function sraShow(Request $request)
    {
        $query = $request->input('group_name');

    $sras = Sra::distinct()
        ->where('group_name', 'LIKE', '%' . $query . '%')
        ->paginate(10);


    // Extracting data for chart
    $labels = ['Transparency', 'RSPO Compliance', 'NDPE Compliance', 'Overall'];
    $data = [];

    // Iterating through each Sra instance to populate $data array
    foreach ($sras as $sra) {
        $data[] = [
            $sra->percent_transparency,
            $sra->percent_rspo_compliance,
            $sra->percent_ndpe_compliance,
            $sra->percent_total
        ];
    }

    // Append the search query to the pagination links
    $sras->appends(['group_name' => $query]);

    return view('webview.overviewSra', compact('sras', 'data', 'labels'));
    }


}