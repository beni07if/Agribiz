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


class WebViewController extends Controller
{
    public function index()
    {
        // $subsidiary = Consolidation::all();
        // $groupNameeee = Consolidation::all();
        $groupCountsDistinct = Group::select('group_name')
        ->distinct()
        ->count('group_name');
        $consolidationCountsDistinct = Consolidation::select('subsidiary')
        ->distinct()
        ->count('subsidiary');
        $shareholderCountsDistinct = CompanyOwnership::select('shareholder_name')
        ->distinct()
        ->union(
            CompanyOwnershipSecond::select('shareholder_name')->distinct()
        )
        ->count('shareholder_name');
        $landingPages = Landingpage::all();
        $faqs = Faq::all();
        return view('webview.homeDynamic', compact('landingPages', 'faqs', 'groupCountsDistinct', 'consolidationCountsDistinct', 'shareholderCountsDistinct'));
        // return view('content.homeDinamicApi');
    }
    
    public function indexApi()
    {
        $landingPages = Landingpage::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Landing pages retrieved successfully.',
            'data' => $landingPages,
        ], 200);
    }

    public function lpd()
    {
        $landingPages = Landingpage::all();
        return view('content.homeDinamis', compact('landingPages'));
    }
    
    public function feature()
    {
        $subsidiary = Consolidation::all();
        $groupName = Consolidation::all();
        return view('content.en.feature.feature', compact('subsidiary', 'groupName'));
    }
    
    public function featureApi()
    {
        $subsidiary = Consolidation::all();
        $groupName = Consolidation::all(); // Consider if you need to fetch this differently

        return response()->json([
            'subsidiary' => $subsidiary,
            'group_name' => $groupName,
        ]);
    }

    public function groupFeature()
    {
        $subsidiary = Consolidation::all();
        $groupName = Consolidation::all();
        $groupCountsDistinct = Group::select('group_name')
        ->distinct()
        ->count('group_name');
        return view('webview.featureGroup', compact('subsidiary', 'groupName', 'groupCountsDistinct'));
    }
    public function subsidiaryFeature()
    {
         $subsidiary = Consolidation::all();
        $groupName = Consolidation::all();
        $groupCountsDistinct = Group::select('group_name')
        ->distinct()
        ->count('group_name');
        return view('webview.featureSubsidiary', compact('subsidiary', 'groupName', 'groupCountsDistinct'));
    }
    public function shareholderFeature()
    {
         $subsidiary = Consolidation::all();
        $groupName = Consolidation::all();
        $groupCountsDistinct = Group::select('group_name')
        ->distinct()
        ->count('group_name');
        return view('webview.featureShareholder', compact('subsidiary', 'groupName', 'groupCountsDistinct'));
    }
    public function sraFeature()
    {
         $subsidiary = Consolidation::all();
        $groupName = Consolidation::all();
        $groupCountsDistinct = Group::select('group_name')
        ->distinct()
        ->count('group_name');
        return view('webview.featureSra', compact('subsidiary', 'groupName', 'groupCountsDistinct'));
    }

    public function searchFunctionGroup(Request $request)
    {
        $query = $request->input('group_name');

        $groups = Group::select('group_name', 'country_registration', 'business_address', 'business_sector')
            ->where('group_name', 'LIKE', '%' . $query . '%')
            ->distinct()
            ->paginate(10);

        // Append the search query to the pagination links
        $groups->appends(['group_name' => $query]);

        return view('webview.searchGroup', compact('groups', 'query'));
    }


    // public function searchFunctionSubsidiary(Request $request)
    // {
    //     $query = $request->input('query');

    //     $consolidations = Consolidation::select('subsidiary')
    //         ->where('subsidiary', 'LIKE', '%' . $query . '%')
    //         ->distinct()
    //         ->paginate(10);

    //     // Append the search query to the pagination links
    //     $consolidations->appends(['query' => $query]);

    //     return view('content.en.searchSubsidiary', compact('consolidations'));
    // }

    // public function searchFunctionSubsidiary(Request $request)
    // {
    //     $query = $request->input('subsidiary');

    //     // Cari data di tabel Consolidation
    //     $consolidations = Consolidation::select('subsidiary', 'country_operation', 'province', 'regency')
    //         ->where('subsidiary', 'LIKE', '%' . $query . '%')
    //         ->distinct()
    //         ->paginate(10);
    //     $companyOwnerships= CompanyOwnership::select('company_name', 'country_of_business_address', 'business_address')
    //         ->where('company_name', 'LIKE', '%' . $query . '%')
    //         ->distinct()
    //         ->paginate(10);

    //     // Jika tidak ditemukan di tabel Consolidation, cari di tabel company ownership
    //     if ($consolidations->isEmpty()) {
    //         $companyOwnerships = CompanyOwnership::select('company_name', 'country_of_registered_address', 'registered_address')
    //             ->where('company_name', 'LIKE', '%' . $query . '%')
    //             ->distinct()
    //             ->paginate(10);

    //         // Append the search query to the pagination links
    //         $companyOwnerships->appends(['query' => $query]);

    //         return view('content.en.searchSubsidiaryCO', compact('companyOwnerships', 'query'));
    //     }

    //     // Jika tidak ditemukan di tabel Consolidation, cari di tabel OtherCompanies
    //     if ($consolidations->isEmpty()) {
    //         $otherCompanies = OtherCompany::select('badan_hukum')
    //             ->where('badan_hukum', 'LIKE', '%' . $query . '%')
    //             ->distinct()
    //             ->paginate(10);

    //         // Append the search query to the pagination links
    //         $otherCompanies->appends(['query' => $query]);

    //         return view('content.en.searchOtherCompany', compact('otherCompanies', 'query'));
    //     } else {
    //         // Append the search query to the pagination links
    //         $consolidations->appends(['query' => $query]);

    //         return view('content.en.searchSubsidiary', compact('consolidations', 'companyOwnerships', 'query'));
    //     }
    // }

    // public function searchFunctionSubsidiary(Request $request)
    // {
    //     // Ambil input dari request
    //     $query = $request->input('subsidiary');

    //     // Subquery untuk mendapatkan nama perusahaan unik
    //     $uniqueCompanyNames = CompanyOwnership::select('company_name')
    //         ->distinct()
    //         ->when($query, function ($q) use ($query) {
    //             return $q->where('company_name', 'LIKE', '%' . $query . '%');
    //         })
    //         ->pluck('company_name'); // Dapatkan hanya nama perusahaan sebagai array

    //     // Query utama dengan join untuk mendapatkan detail berdasarkan nama perusahaan unik
    //     $companyOwnerships = CompanyOwnership::select(
    //         'company_ownerships.company_name',
    //         'consolidations.subsidiary',
    //         'consolidations.country_operation',
    //         'consolidations.province',
    //         'consolidations.regency',
    //         'company_ownerships.country_of_business_address',
    //         'company_ownerships.business_address',
    //         'company_ownerships.registered_address'
    //     )
    //     ->leftJoin('consolidations', 'company_ownerships.company_name', '=', 'consolidations.subsidiary')
    //     ->whereIn('company_ownerships.company_name', $uniqueCompanyNames)
    //     ->groupBy(
    //         'company_ownerships.company_name',
    //         'consolidations.subsidiary',
    //         'consolidations.country_operation',
    //         'consolidations.province',
    //         'consolidations.regency',
    //         'company_ownerships.country_of_business_address',
    //         'company_ownerships.business_address',
    //         'company_ownerships.registered_address'
    //     )
    //     ->orderBy('company_ownerships.company_name')
    //     ->paginate(10);

    //     // Append parameter pencarian ke link pagination
    //     $companyOwnerships->appends(['subsidiary' => $query]);

    //     // Kembalikan ke view dengan nama variabel yang benar
    //     return view('content.en.searchSubsidiary', [
    //         'companyOwnerships' => $companyOwnerships,
    //         'query' => $query
    //     ]);
    // }

    public function searchFunctionSubsidiary(Request $request)
{
    // Ambil input dari request
    $query = $request->input('subsidiary');

    // Ambil data dari tabel CompanyOwnership
    $companyOwnerships = DB::table('company_ownerships')
        ->select(
            'company_ownerships.company_name',
            'consolidations.subsidiary',
            'consolidations.country_operation',
            'consolidations.province',
            'consolidations.regency',
            'company_ownerships.country_of_business_address',
            'company_ownerships.business_address',
            'company_ownerships.registered_address'
        )
        ->leftJoin('consolidations', 'company_ownerships.company_name', '=', 'consolidations.subsidiary')
        ->when($query, function ($q) use ($query) {
            return $q->where('company_ownerships.company_name', 'LIKE', '%' . $query . '%');
        });

    // Ambil data dari tabel CompanyOwnershipSecond
    $companyOwnershipsSecond = DB::table('company_ownership_seconds')
        ->select(
            'company_ownership_seconds.company_name',
            'consolidations.subsidiary',
            'consolidations.country_operation',
            'consolidations.province',
            'consolidations.regency',
            'company_ownership_seconds.country_of_business_address',
            'company_ownership_seconds.business_address',
            'company_ownership_seconds.registered_address'
        )
        ->leftJoin('consolidations', 'company_ownership_seconds.company_name', '=', 'consolidations.subsidiary')
        ->when($query, function ($q) use ($query) {
            return $q->where('company_ownership_seconds.company_name', 'LIKE', '%' . $query . '%');
        });

    // Gabungkan kedua query dengan UNION dan pastikan company_name unik
    $allCompanyOwnerships = $companyOwnerships
        ->union($companyOwnershipsSecond)
        ->distinct() // Menghilangkan duplikat berdasarkan semua kolom
        ->get()
        ->unique('company_name'); // Hapus duplikat berdasarkan company_name

    // Lakukan pagination manual
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 10; // Set jumlah item per halaman
    $currentItems = $allCompanyOwnerships->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $paginatedCompanyOwnerships = new LengthAwarePaginator($currentItems, $allCompanyOwnerships->count(), $perPage);
    $paginatedCompanyOwnerships->setPath($request->url());
    $paginatedCompanyOwnerships->appends(['subsidiary' => $query]);

    // Kembalikan ke view dengan data yang digabungkan
    return view('webview.searchSubsidiary', [
        'companyOwnerships' => $paginatedCompanyOwnerships,
        'query' => $query
    ]);
}


    // public function searchFunctionShareholder(Request $request)
    // {
    //     $shareholder = $request->input('shareholder_name');
        
    //     $groups = DB::table('groups')
    //     ->where('shareholder_name1', $shareholder)
    //     ->orWhere('shareholder_name2', $shareholder)
    //     ->orWhere('shareholder_name3', $shareholder)
    //     ->orWhere('shareholder_name4', $shareholder)
    //     ->orWhere('shareholder_name5', $shareholder)
    //     ->get();  

    //     $shareholderNames = CompanyOwnership::select('id','shareholder_name', 'company_name', 'date_of_birth', 'ic_passport_comp_number', 'address')
    //         ->where('shareholder_name', 'LIKE', '%' . $shareholder . '%')
    //         ->paginate(10);

    //     // Append the search shareholder_name to the pagination links
    //     $shareholderNames->appends(['shareholder_name' => $shareholder]);

    //     return view('content.en.searchShareholder', compact('shareholderNames', 'shareholder', 'groups'));
    // }

    public function searchFunctionShareholder(Request $request)
    {
        $shareholder = $request->input('shareholder_name');

        // Ambil data dari tabel groups
        $groups = DB::table('groups')
            ->where('shareholder_name1', $shareholder)
            ->orWhere('shareholder_name2', $shareholder)
            ->orWhere('shareholder_name3', $shareholder)
            ->orWhere('shareholder_name4', $shareholder)
            ->orWhere('shareholder_name5', $shareholder)
            ->get();

        // Ambil data dari tabel CompanyOwnership
        $companyOwnerships = DB::table('company_ownerships')
            ->select('id', 'shareholder_name', 'company_name', 'date_of_birth', 'ic_passport_comp_number', 'address')
            ->where('shareholder_name', 'LIKE', '%' . $shareholder . '%');

        // Ambil data dari tabel CompanyOwnershipSecond
        $companyOwnershipsSecond = DB::table('company_ownership_seconds')
            ->select('id', 'shareholder_name', 'company_name', 'date_of_birth', 'ic_passport_comp_number', 'address')
            ->where('shareholder_name', 'LIKE', '%' . $shareholder . '%');

        // Gabungkan kedua query dengan UNION
        $allShareholderNames = $companyOwnerships
            ->union($companyOwnershipsSecond)
            ->orderBy('shareholder_name')
            ->paginate(10);

        // Append parameter pencarian ke link pagination
        $allShareholderNames->appends(['shareholder_name' => $shareholder]);

        // Kembalikan ke view dengan data yang digabungkan
        return view('webview.searchShareholder', [
            'shareholderNames' => $allShareholderNames,
            'shareholder' => $shareholder,
            'groups' => $groups
        ]);
    }

    public function searchFunctionSRA(Request $request)
    {
        // Ambil input dari request
        $query = $request->input('group_name');

        // Mulai query untuk mengambil data
        $sras = Sra::select(
            'sras.group_name',
            'sras.percent_transparency',
            'sras.percent_ndpe_compliance',
            'sras.percent_rspo_compliance',
            'groups.business_address',
            'groups.country_registration' // Tambahkan country_registration
        )
        ->leftJoin('groups', 'sras.group_name', '=', 'groups.group_name')  // Join dengan table groups
        ->distinct();

        // Jika ada query pencarian, tambahkan kondisi where
        if (!empty($query)) {
            $sras = $sras->where('sras.group_name', 'LIKE', '%' . $query . '%');
        }

        // Paginate hasilnya
        $sras = $sras->paginate(10);

        // Append parameter pencarian ke link pagination
        $sras->appends(['group_name' => $query]);

        // Kembalikan ke view
        return view('webview.searchSra', ['sras' => $sras, 'query' => $query]);
    }

    public function privacyPolicy()
    {
        $policies = Policy::all();
        return view('content.footer.privacyPolicy', compact('policies'));
    }

    public function termAndCondition()
    {
        $termAndCondition = Termcondition::all();
        return view('content.footer.termAndCondition', compact('termAndCondition'));
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
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





    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     //
    // }
}