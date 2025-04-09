<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Parcelle;
use App\Models\Semis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    public function loadStats()
    {
        $totalUsers = User::count();
        $totalActiveUsers = User::where('active', true)->count();
        $totalInactiveUsers = User::where('active', false)->count();

        $totalAdmins = User::where('role_id', 1)->count();
        $totalActiveAdmins = User::where('role_id', 1)->where('active', true)->count();
        $totalInactiveAdmins = User::where('role_id', 1)->where('active', false)->count();

        $totalFarmers = User::where('role_id', 2)->count();
        $totalActiveFarmers = User::where('role_id', 2)->where('active', true)->count();
        $totalInactiveFarmers = User::where('role_id', 2)->where('active', false)->count();


        /* Nombre de cultures */
        $numberOfCrops = Culture::count();

        /* Pour les administrateurs */
        $numberOfPlots = Parcelle::count();
        /* En culture */
        $cultivatedPlots = Parcelle::where('statut_id', 1)->count();
        $cultivatedPlotsArea = Parcelle::where('statut_id', 1)->sum('surface');
        /* Récoltée */
        $harvestedPlot = Parcelle::where('statut_id', 2)->count();
        $harvestedPlotArea = Parcelle::where('statut_id', 2)->sum('surface');
        /* En jachère */
        $fallowLand = Parcelle::where('statut_id', 3)->count();
        $fallowLandArea = Parcelle::where('statut_id', 3)->sum('surface');

        $totalArea = Parcelle::sum('surface');

        /* Pour les agriculteurs */
        $farmerPlotsNumber = Parcelle::where('user_id', Auth::user()->id)->count();
        $farmerCultivatedPlots = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', 1)->count();
        $farmerCultivatedPlotsArea = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', operator: 1)->sum('surface');

        $farmerHarvestedPlot = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', 2)->count();
        $farmerHarvestedPlotArea = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', operator: 2)->sum('surface');

        $farmerFallowLand = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', 3)->count();
        $farmerFallowLandArea = Parcelle::where('user_id', Auth::user()->id)
            ->where('statut_id', operator: 3)->sum('surface');
        $farmerTotalArea = Parcelle::where('user_id', Auth::user()->id)
            ->sum('surface');



        /* Semis */
        $semisnonArroses = Semis::where("user_id", Auth::id())
            ->whereNull('recolte_id')
            ->withCount('arrosage')
            ->having('arrosage_count', '=', 0)
            ->get();

        $stats = [
            'users' => [
                'total' => $totalUsers,
                'active' => $totalActiveUsers,
                'inactive' => $totalInactiveUsers,
                'admins' => [
                    'total' => $totalAdmins,
                    'active' => $totalActiveAdmins,
                    'inactive' => $totalInactiveAdmins,
                ],
                'farmers' => [
                    'total' => $totalFarmers,
                    'active' => $totalActiveFarmers,
                    'inactive' => $totalInactiveFarmers,
                ],
            ],
            'cultures' => [
                'total' => $numberOfCrops,
            ],
            'semis' =>[
                "nonArroses" => $semisnonArroses->count(),
            ],
            'parcelles' => [
                'total' => $numberOfPlots,
                'totalArea' => $totalArea,
                'cultivated' => [
                    'total' => $cultivatedPlots,
                    'totalArea' => $cultivatedPlotsArea,
                ],
                'harvested' => [
                    'total' => $harvestedPlot,
                    'totalArea' => $harvestedPlotArea,
                ],
                'fallow' => [
                    'total' => $fallowLand,
                    'totalArea' => $fallowLandArea,
                ],
            ],
            'parcelleAgriculteur' => [
                'total' => $farmerPlotsNumber,
                'totalArea' => $farmerTotalArea,
                'cultivated' => [
                    'total' => $farmerCultivatedPlots,
                    'totalArea' => $farmerCultivatedPlotsArea,
                ],
                'harvested' => [
                    'total' => $farmerHarvestedPlot,
                    'totalArea' => $farmerHarvestedPlotArea,
                ],
                'fallow' => [
                    'total' => $farmerFallowLand,
                    'totalArea' => $farmerFallowLandArea,
                ],
            ],
        ];
        return $stats;
    }
    public function dashboard()
    {
        $stats = $this->loadStats();
        return view('pages.dashboard', compact('stats'));
    }
    public function semisNonArroses()
    {
        $semis = Semis::where("user_id", Auth::id())
            ->whereNull('recolte_id')
            ->withCount('arrosage')
            ->having('arrosage_count', '=', 0)
            ->get();

        return view('pages.semis.non-arroses', compact('semis'));
    }
    public function charts()
    {
        $stats = $this->loadStats();
        return view('pages.graphes', compact('stats'));
    }
}
