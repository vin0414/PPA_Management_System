@extends('layouts.main')

@section('content')
<div class="page-body">
    <div class="container p-4">
        <div class="tabs tabs-box">
            @auth
            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Activity Proposal Form" checked="checked" />
            <div class="tab-content">
                <form method="POST" class="grid gap-4" id="form">
                    @csrf
                    <div class="grid-cols-12">
                        <div class="card bg-base-100 shadow-sm card-body grid gap-4">
                            <div class="grid-cols-12">
                                A. Program Logic Alignment<br />
                                <small>Select the DEDP framework path this activity supports. Each level filters the
                                    next.</small>
                            </div>
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-4">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                                1. GOAL
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="goal">
                                            <option disabled selected>Select a goal</option>
                                            <option value="ARAL">ARAL (Academic Excellence)</option>
                                            <option value="ALAGA">ALAGA (Holistic Well-being & Safety)</option>
                                            <option value="ASAL">ASAL (Character & Values-driven Formation)</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                                2. PILLAR
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="pillar" id="pillar">
                                            <option disabled selected>Select a pillar</option>
                                            <option value="LINANG">LINANG (Learning-Focus Delivery & Resources)</option>
                                            <option value="AGAPAY">AGAPAY (Access, Equity, & Inclusion)</option>
                                            <option value="BUKLOD">BUKLOD (Stakeholder's Engagement)</option>
                                            <option value="OPTIMA">OPTIMA (E-Governance and Digital Transformation)
                                            </option>
                                            <option value="NUMBALIK">NUMBALIK (Safety, Well-Being & Disaster
                                                Preparedness)
                                            </option>
                                            <option value="GALING">GALING (Human Resource Excellence)</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                                3. PROJECT
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="project" id="project">
                                            <option disabled selected>Select a project</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="grid-cols-12">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            4. LEAD MEASURE
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="lead_measure" id="lead_measure">
                                        <option disabled selected>Select a lead measure</option>
                                    </select>
                                </label>
                            </div>
                            <div class="grid-cols-12">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            5. STRATEGY
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="strategy" id="strategy">
                                        <option disabled selected>Select a strategy</option>
                                    </select>
                                </label>
                            </div>
                            <div class="grid-cols-12">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            6. Output
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="output" id="output">
                                        <option disabled selected>Select an output</option>
                                    </select>
                                </label>
                            </div>
                            <div class="grid-cols-12">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            7. TARGET
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="target" id="target">
                                        <option disabled selected>Select a target</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-base-100 shadow-sm card-body grid-cols-12">
                        <div class="grid-cols-12">
                            B. Activity Proposal<br />
                            <small>Details of the proposed program, project, or activity (PPA) and its automated
                                priority
                                scoring.</small>
                        </div>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-6">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            PROPONENT
                                        </span>
                                    </div>
                                    <input type="text" class="input w-full" name="proponent"
                                        placeholder="Office, unit or school proposing this" />
                                </label>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            TITLE OF ACTIVITY
                                        </span>
                                    </div>
                                    <input type="text" class="input w-full" name="activity"
                                        placeholder="e.g. Division Reading Recovery Camp" />
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 md:col-span-4">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            PROPOSED AMOUNT (₱)
                                        </span>
                                    </div>
                                    <input type="number" class="input w-full" name="amount" />
                                </label>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                            ACTIVITY TYPE
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="activity_type">
                                        <option disabled selected>Select type</option>
                                        <option value="1">Capacity Building/Competitions/Conferences
                                        </option>
                                        <option value="2">Activity/Event</option>
                                        <option value="3">Reports/Meetings/Monitoring</option>
                                        <option value="4">Development</option>
                                    </select>
                                </label>
                            </div>
                            <div class="col-span-12 md:col-span-4">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-bold text-base-content/70">
                                            TIER CATEGORY
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="tier_category">
                                        <option disabled selected>Select Tier</option>
                                        <option>Tier 1 : Mandated</option>
                                        <option>Tier 2 : Initiated</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-3">
                            <div class="col-span-12 md:col-span-6">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-bold text-base-content/70">
                                            EQUITY INDEX (1-5)
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="equity_index">
                                        <option disabled selected>Select score</option>
                                        <option value="1">1 : Minimal equity impact</option>
                                        <option value="2">2 : Low equity impact</option>
                                        <option value="3">3 : Moderate equity impact</option>
                                        <option value="4">4 : High equity impact</option>
                                        <option value="5">5 : Transformative equity impact</option>
                                    </select>
                                </label>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="form-control w-full">
                                    <div class="label py-0.5">
                                        <span class="label-text-alt text-xs font-bold text-base-content/70">
                                            TARGET ALIGNMENT (1-5)
                                        </span>
                                    </div>
                                    <select class="select select-bordered w-full" name="target_alignment">
                                        <option disabled selected>Select score</option>
                                        <option value="1">1 : Weak alignment to target</option>
                                        <option value="2">2 : Slight alignment to target</option>
                                        <option value="3">3 : Moderate alignment to target</option>
                                        <option value="4">4 : Strong alignment to target</option>
                                        <option value="5">5 : Direct, full alignment to target</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="grid-cols-12">
                            <span class="text-warning font-bold">AUTOMATED COMPUTATION</span>
                            <div class="card bg-base-100 shadow-sm">
                                <div class="card-body">
                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-12 md:col-span-9">
                                            <h2 class="text-xl font-bold" id="investment_priority">0</h2>
                                            <p
                                                class="text-xs font-semibold tracking-wide uppercase text-base-content/70">
                                                Investment Priority (Equity × Alignment, 1–25)
                                            </p>
                                        </div>
                                        <div class="col-span-12 md:col-span-3">
                                            <h2 class="text-md" id="investment_priority">Remarks</h2>
                                            <span class="badge bg-neutral text-white" id="remarks">Awaiting
                                                Response</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" form-control mt-6">
                            <button type="submit" class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white">
                                Save Proposal
                            </button>
                            <button type="reset" class="btn bg-default">
                                Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endAuth
            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Consolidated Dashboard" @guest checked="checked" @endguest />
            <div class="tab-content">
                <div class="grid gap-3">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <!-- Card 1: Total Proposals -->
                        <div class="card bg-base-100 shadow-sm border border-t-4">
                            <div class="card-body">
                                <h2 class="text-xl font-bold">0</h2>
                                <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Total
                                    Proposals</p>
                            </div>
                        </div>

                        <!-- Card 2: Budget -->
                        <div class="card bg-base-100 shadow-sm border border-t-4">
                            <div class="card-body">
                                <h2 class="text-xl font-bold">₱ 0.00</h2>
                                <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Proposed
                                    Budget</p>
                            </div>
                        </div>

                        <!-- Card 3: High Priority -->
                        <div class="card bg-base-100 shadow-sm border border-t-4">
                            <div class="card-body">
                                <h2 class="text-xl font-bold">0</h2>
                                <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">High
                                    Priority</p>
                            </div>
                        </div>

                        <!-- Card 4: Moderate Priority -->
                        <div class="card bg-base-100 shadow-sm border border-t-4">
                            <div class="card-body">
                                <h2 class="text-xl font-bold">0</h2>
                                <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Moderate
                                    Priority</p>
                            </div>
                        </div>

                        <!-- Card 5: New Metric (e.g., Low Priority or Approved) -->
                        <div class="card bg-base-100 shadow-sm border border-t-4">
                            <div class="card-body">
                                <h2 class="text-xl font-bold">0</h2>
                                <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Low
                                    Priority</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-cols-12">
                        <div class="card bg-base-100 w-full shadow-sm">
                            <div class="card-body">
                                <form method="GET" class="grid" id="form">
                                    <div class="grid grid-cols-12 gap-4 mb-2">
                                        <div class="col-span-12 md:col-span-2">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                        PROJECT
                                                    </span>
                                                </div>
                                                <select class="select select-bordered w-full" name="project">
                                                    <option disabled selected>All Projects</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col-span-12 md:col-span-2">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                        PROPONENT
                                                    </span>
                                                </div>
                                                <input type="search" class="input" name="proponent"
                                                    placeholder="Search proponent" />
                                            </label>
                                        </div>
                                        <div class="col-span-12 md:col-span-2">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                        TIER CATEGORY
                                                    </span>
                                                </div>
                                                <select class="select select-bordered w-full" name="tier">
                                                    <option disabled selected>All Tiers</option>
                                                    <option>Tier 1 : Mandated</option>
                                                    <option>Tier 2 : Initiated</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col-span-12 md:col-span-4">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                        ACTIVITY TYPE
                                                    </span>
                                                </div>
                                                <select class="select select-bordered w-full" name="activity">
                                                    <option disabled selected>All Types</option>
                                                    <option value="1">Capacity Building/Competitions/Conferences
                                                    </option>
                                                    <option value="2">Activity/Event</option>
                                                    <option value="3">Reports/Meetings/Monitoring</option>
                                                    <option value="4">Development</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col-span-12 md:col-span-2">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                        PRIORITY LEVEL
                                                    </span>
                                                </div>
                                                <select class="select select-bordered w-full" name="priority">
                                                    <option disabled selected>All Levels</option>
                                                    <option value="1">High Priority</option>
                                                    <option value="2">Moderate Priority</option>
                                                    <option value="3">Low Priority</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <button type="submit"
                                                class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white">
                                                Search
                                            </button>
                                            <button type="reset" class="btn bg-default">
                                                Clear Filters
                                            </button>
                                        </div>
                                        <div class="flex justify-end">
                                            <a href="" class="btn btn-default">Export CSV</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="grid-cols-12">
                        <div class="overflow-hidden rounded-md border border-gray-200 shadow-sm">
                            <table class="table table-zebra table-xs w-full" id="list">
                                <thead class="bg-blue-900 text-white text-xs">
                                    <tr>
                                        <th>PROPONENT</th>
                                        <th>TITLE</th>
                                        <th>GOAL</th>
                                        <th>PILLAR</th>
                                        <th>PROJECT</th>
                                        <th>TIER</th>
                                        <th>AMOUNT</th>
                                        <th>SCORE</th>
                                        <th>PRIORITY</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
