<x-layout>
    <x-breadcrumbs class="mb-4" :links="[
        'Jobs' => route('jobs.index'), $job->title =>
     route('jobs.show',$job), 'Apply'=>'#']"></x-breadcrumbs>

     <x-job-card :$job></x-job-card>
    <x-card>
        <h2 class="mb-4 text-lfg font-medium">
            Your Job application
        </h2>

        <form action="{{ route('job.application.store', $job) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <x-label for="expected_salary" :required="true">
                Expected Salary
            </x-label>
            <x-text-input type="number" name="expected_salary">

            </x-text-input>

        </div>

        <div class="mb-4">
            <x-label for="cv" :required="true"> Upload CV</x-label>
            <x-text-input type="file" name="cv"></x-text-input>
        </div>

        <x-button class="w-full"> Apply</x-button>
    </form>
    </x-card>
</x-layout>
