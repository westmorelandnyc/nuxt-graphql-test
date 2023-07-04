<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->unsignedBigInteger('project_manager')->nullable(false);
            $table->timestamps();
            
            $table->foreign('project_manager')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->foreignId('job_id')->constrained('jobs')->cascadeOnDelete();
            $table->timestamps();

        });


        // Schema::create('jobs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->nullable(false);
        //     $table->string('number')->unique()->nullable(false);
        //     $table->enum('status', ['Tracking'])->default('Tracking');
        //     $table->unsignedBigInteger('company_id');
        //     $table->float('estimated_costs')->nullable();
        //     $table->float('estimated_billings')->nullable();
        //     $table->unsignedBigInteger('project_manager')->nullable(false);
        //     $table->timestamp('bid_submitted_at')->nullable();
        //     $table->timestamp('job_awarded_at')->nullable();
        //     $table->timestamp('projected_start_of_work')->nullable();
        //     $table->timestamp('projected_completion_of_work')->nullable();
        //     $table->timestamp('scheduled_bid_date')->nullable();
        //     $table->timestamp('prebid_meeting_date')->nullable();
        //     $table->text('estimator_notes_and_comments')->nullable();
        //     $table->string('mp_decision')->nullable();
        //     $table->float('estimated_bid_value')->nullable();
        //     $table->text('bid_item_sheet')->nullable();
        //     $table->text('plans_and_specs')->nullable();
        //     $table->text('short_summary_of_work')->nullable();
        //     $table->text('bid_documents')->nullable();
        //     $table->string('hcss_bid_num')->nullable();
        //     $table->string('low_bidder')->nullable();
        //     $table->float('low_bid')->nullable();
        //     $table->float('wci_bid')->nullable();
        //     $table->unsignedInteger('num_bidders')->nullable();
        //     $table->unsignedInteger('wci_bid_place')->nullable();
        //     $table->text('bid_results')->nullable();
        //     $table->string('civil_bid_documents')->nullable();
            
        //     $table->foreign('company_id')->references('id')->on('companies');
        //     $table->foreign('project_manager')->references('id')->on('users');
        // });

        // Schema::create('locations', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('identifier')->unique();
        //     $table->foreignId('job_id')->constrained('jobs')->nullable(false);
        //     $table->string('address')->nullable()->comment('Address');
        //     $table->foreignId('default_phase')->nullable()->constrained('phases');
        //     $table->text('permit_work_hours')->nullable()->comment('## Multi Select:\n* M-F,\n* Nights,\n* Sat/Sun');
        //     $table->integer('linear_feet')->nullable(false);
        //     $table->timestamp('code_53_markout_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`? this is when WCI told all utiliies to mark out the block by');
        //     $table->enum('status', ['NULL', 'location_statuses'])->nullable()->comment('Single Select')->default('NULL');
        //     $table->timestamp('completed_at')->nullable(false);
        //     $table->float('invoice_amount')->nullable()->comment('Currency');
        //     $table->timestamp('invoiced_at')->nullable();
        //     $table->timestamp('paid_at')->nullable();
        //     $table->string('status_comments')->nullable();
        //     $table->timestamp('permit_starts_at')->nullable(false);
        //     $table->timestamp('permit_ends_on')->nullable(false);
        //     $table->boolean('is_protected')->nullable();
        //     $table->boolean('has_building_access')->nullable();
        //     $table->float('payment')->nullable()->comment('Currency');
        //     $table->text('permits')->nullable()->comment('File Upload | "Permit(s)"');
        //     $table->integer('location_id')->nullable()->unique();
        //     $table->boolean('has_notice_to_proceed')->nullable();
        //     $table->timestamp('permit_applied_at')->nullable(false);
        //     $table->timestamp('permit_paid_at')->nullable(false);
        //     $table->timestamp('walk_thru_on')->nullable();
        //     $table->string('invoice_num')->nullable()->comment('"Invoice #"');
        //     $table->string('permit_application_num')->nullable(false)->comment('"Permit Application #');
        //     $table->enum('type', ['NULL', 'location_types'])->nullable()->comment('Multi Select')->default('NULL');
        //     $table->text('special_stipulations')->nullable()->comment('## Multi Select\n* Cobblestones\n* Mill/Pave\n* Concrete Panels\n* Road Closure');
        //     $table->foreignId('project_manager')->constrained('users');
        //     $table->timestamp('permit_start_time')->nullable(false);
        //     $table->timestamp('permit_end_time')->nullable(false);
        //     $table->timestamp('scheduled_work_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->string('code_53_ticket_num')->nullable()->comment('"Code 53 Ticket #"');
        //     $table->timestamp('permit_approved_at')->nullable(false);
        //     $table->string('po_num')->nullable()->comment('"PO #"');
        //     $table->timestamp('po_requested_at')->nullable();
        //     $table->text('po_file')->nullable()->comment('File Upload');
        //     $table->float('po_amount')->nullable()->comment('Currency');
        //     $table->string('phase')->nullable()->comment('"Phase #"');
        //     $table->enum('job_type', ['job_types'])->nullable()->comment('Multi Select')->nullable(false);
        //     $table->foreignId('company_id')->constrained('companies');
        //     $table->string('permit_num')->nullable(false)->comment('"Permit #"');
        //     $table->string('mikes_notes')->nullable();
        //     $table->string('traffic_stipulations_and_closures')->nullable();
        //     $table->timestamp('surveyed_at')->nullable();
        //     $table->string('survey_notes')->nullable();
        //     $table->text('survey_docs')->nullable()->comment('File Upload');
        //     $table->string('surveyor')->nullable()->comment("🟨 probably link to a user account instead of varchar\n## Single Select\n* Anthony DeGeorge\n* Gillie Etnel\n* Iwan Belfor\n* Lesley Feller\n* Luca\n* A DeGeorge\n* E Newberry\n* J Gorman\n* Stephen Paletta");
        //     $table->boolean('has_request_survey')->default(false);
        //     $table->string('survey_priority')->nullable()->comment("## Single Select\n* B: High Priority\n* C: Medium Priority\n* High Priority\n* Low Priority\n* Medium Priority\n* Schedule Immediately");
        //     $table->text('plan_drawing')->nullable()->comment('File Upload');
        //     $table->string('owner_representative')->nullable();
        //     $table->timestamp('final_restoration')->nullable();
        //     $table->string('micro_id')->nullable();
        //     $table->boolean('has_correctly_completed_dailies')->nullable();
        //     $table->enum('has_ordered_final_restoration', ['N/A', 'No', 'Yes'])->nullable()->comment("## Single Select\n* N/A\n* No\n* Yes");
        //     $table->boolean('has_submitted_invoice_package_been')->nullable();
        //     $table->enum('has_protected_street_been_logged', ['N/A', 'No', 'Yes'])->nullable()->comment("## Single Select\n* N/A\n* No\n* Yes");
        //     $table->boolean('has_emergency_location')->nullable()->comment('"Emergency Location?"');
        //     $table->timestamp('ntp_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->timestamp('po_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->boolean('is_on_hold')->nullable();
        //     $table->timestamp('rfp_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->string('bid_by')->nullable()->comment("## Single Select\n* Cindy Marcelino\n* Ethan Newberry\n* Mike Paletta\n* Steve Paletta");
        //     $table->timestamp('bid_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->text('bid_package')->nullable()->comment('File Upload');
        //     $table->text('rfp_email')->nullable()->comment('File Upload');
        //     $table->timestamp('survey_request_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->timestamp('barrel_completion_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->enum('vz_schedule_status', ['Not Requested Yet', 'Requested', 'Confirmed'])->nullable()->comment("## Single Select\n* Not Requested Yet\n* Requested\n* Confirmed");
        //     $table->text('submitted_price_proposal')->nullable()->comment('File Upload');
        //     $table->string('bid_in_review')->nullable()->comment("## Single Select\n* Ethan Newberry\n* Mike Paletta");
        //     $table->boolean('was_bid_awarded')->nullable();
        //     $table->timestamp('award_date')->nullable()->comment('🟨 name changeable to `_on` or `_at`?');
        //     $table->enum('bid_status', ['Single Select'])->nullable()->comment('Single Select');
        //     $table->boolean('job_cleanup_work_order_scheduled')->nullable();
        //     $table->timestamp('most_recent_setup_created_at')->nullable();
        //     $table->boolean('is_vz_inspection_required')->nullable();
        //     $table->text('cost_estimate')->nullable()->comment('File Upload');
        //     $table->string('bid_notes')->nullable();
        //     $table->text('asbuilt_drawing')->nullable()->comment('File Upload | "As-Built Drawing"');
        //     $table->text('invoice_package')->nullable()->comment('File Upload');
        //     $table->text('change_order_invoice_package')->nullable()->comment('File Upload');
        //     $table->boolean('is_affiliated_location')->nullable()->comment('🟨 WCI doesnt know what this is for but maybe it was used to allow multiple location to attach to a single Phase');
        //     $table->text('preconstruction_photo_wallet')->nullable()->comment('File Upload');
        //     $table->text('construction_photo_wallet')->nullable()->comment('File Upload');
        //     $table->text('preconstruction_video')->nullable()->comment('File Upload');
        //     $table->text('postconstruction_video')->nullable()->comment('File Upload');
        //     $table->string('google_drive_link')->nullable()->comment('URL / Link');
        //     $table->boolean('is_paving_required')->default(true);
        //     $table->enum('cleanup_request_status', ['Single Select'])->nullable()->comment('Single Select');
        //     $table->string('cleanup_description')->nullable();
        //     $table->foreignId('default_cost_code_id')->constrained('cost_codes');
        //     $table->timestamps();
        // });        
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('locations');
    }
};
