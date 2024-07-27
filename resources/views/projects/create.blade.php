@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Create Project</h1>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="mainImage">Main Image:</label>
                    <input type="file" id="mainImage" name="mainImage" class="form-control mb-2" accept="image/*"
                        required>
                </div>

                <div class="form-group">
                    <label for="shortDesc">Short Description:</label>
                    <textarea id="shortDesc" name="shortDesc" class="form-control" required>{{ old('shortDesc') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea id="desc" name="desc" class="form-control" required>{{ old('desc') }}</textarea>
                </div>

                <!-- Overview section -->
                <h4>Overview</h4>
                <div class="form-group">
                    <label for="overview_name">Name:</label>
                    <input type="text" id="overview_name" name="overview[name]" class="form-control"
                        value="{{ old('overview.name') }}" required>
                </div>

                <div class="form-group">
                    <label for="overview_duration">Duration:</label>
                    <input type="text" id="overview_duration" name="overview[duration]" class="form-control"
                        value="{{ old('overview.duration') }}" required>
                </div>

                <div class="form-group">
                    <label for="overview_tech">Tech:</label>
                    <input type="text" id="overview_tech" name="overview[tech]" class="form-control"
                        value="{{ old('overview.tech') }}" required>
                </div>

                <div class="form-group">
                    <label for="overview_role">Role:</label>
                    <input type="text" id="overview_role" name="overview[role]" class="form-control"
                        value="{{ old('overview.role') }}" required>
                </div>

                <!-- Features section -->
                <h4>Features</h4>
                <div id="features-container">
                    <div class="feature-row form-group">
                        <label for="features_title_0">Title:</label>
                        <input type="text" id="features_title_0" name="features[0][title]" class="form-control mb-2"
                            value="{{ old('features.0.title') }}" required>
                        <label for="features_desc_0">Description:</label>
                        <textarea id="features_desc_0" name="features[0][desc]" class="form-control" required>{{ old('features.0.desc') }}</textarea>
                    </div>
                </div>
                <button type="button" id="add-feature" class="btn btn-secondary mb-2">Add Feature</button>

                <!-- Technical section -->
                <h4>Technical</h4>
                <div id="technical-container">
                    <div class="technical-row form-group">
                        <label for="technical_title_0">Title:</label>
                        <input type="text" id="technical_title_0" name="technical[0][title]" class="form-control mb-2"
                            value="{{ old('technical.0.title') }}" required>
                        <label for="technical_desc_0">Description:</label>
                        <textarea id="technical_desc_0" name="technical[0][desc]" class="form-control" required>{{ old('technical.0.desc') }}</textarea>
                    </div>
                </div>
                <button type="button" id="add-technical" class="btn btn-secondary mb-2">Add Technical</button>

                <!-- Challenge section -->
                <h4>Challenge</h4>
                <div id="challenge-container">
                    <div class="challenge-row form-group">
                        <label for="challenge_title_0">Title:</label>
                        <input type="text" id="challenge_title_0" name="challenge[0][title]" class="form-control mb-2"
                            value="{{ old('challenge.0.title') }}" required>
                        <label for="challenge_desc_0">Description:</label>
                        <textarea id="challenge_desc_0" name="challenge[0][desc]" class="form-control" required>{{ old('challenge.0.desc') }}</textarea>
                    </div>
                </div>
                <button type="button" id="add-challenge" class="btn btn-secondary mb-2">Add Challenge</button>

                <!-- ScreenShots section -->
                <h4>ScreenShots</h4>
                <div id="screenshots-container">
                    <div class="screenshots-row form-group">
                        <label for="screenshots_title_0">Title:</label>
                        <input type="text" id="screenshots_title_0" name="screenshots[0][title]"
                            class="form-control mb-2" value="{{ old('screenshots.0.title') }}" required>
                        <label for="screenshots_desc_0">Description:</label>
                        <textarea id="screenshots_desc_0" name="screenshots[0][desc]" class="form-control mb-2" required>{{ old('screenshots.0.desc') }}</textarea>
                        <label for="screenshots_images_0_image">Image:</label>
                        <input type="file" id="screenshots_images_0_image" name="screenshots[0][images][]"
                            class="form-control mb-2 screenshot-upload" accept="image/*" multiple>
                    </div>
                </div>
                <button type="button" id="add-screenshots" class="btn btn-secondary mb-2">Add Screenshots Row</button>

                <div class="form-group">
                    <label for="outcome">Outcome:</label>
                    <textarea id="outcome" name="outcome" class="form-control" required>{{ old('outcome') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="conclusion">Conclusion:</label>
                    <textarea id="conclusion" name="conclusion" class="form-control" required>{{ old('conclusion') }}</textarea>
                </div>

                <!-- Reference Link section -->
                <h4>Reference Link</h4>
                <div id="reference-container">
                    <div class="reference-row form-group">
                        <label for="reference_text_0">Text:</label>
                        <input type="text" id="reference_text_0" name="reference[0][text]" class="form-control mb-2"
                            value="{{ old('reference.0.text') }}">
                        <label for="reference_link_0">Link:</label>
                        <input type="text" id="reference_link_0" name="reference[0][link]" class="form-control mb-2"
                            value="{{ old('reference.0.link') }}">
                    </div>
                </div>
                <button type="button" id="add-reference" class="btn btn-secondary mb-2">Add Reference Link</button>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to handle dynamic rows -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let featureIndex = 1;
            let technicalIndex = 1;
            let challengeIndex = 1;
            let screenshotIndex = 1;
            let referenceIndex = 1;

            // Add Feature
            document.getElementById('add-feature').addEventListener('click', function() {
                const container = document.getElementById('features-container');
                const newFeatureRow = document.createElement('div');
                newFeatureRow.classList.add('feature-row', 'form-group');
                newFeatureRow.setAttribute('data-index', featureIndex);

                newFeatureRow.innerHTML = `
                    <label for="features_title_${featureIndex}">Title:</label>
                    <input type="text" id="features_title_${featureIndex}" name="features[${featureIndex}][title]" class="form-control mb-2" required>
                    <label for="features_desc_${featureIndex}">Description:</label>
                    <textarea id="features_desc_${featureIndex}" name="features[${featureIndex}][desc]" class="form-control" required></textarea>
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-feature" data-index="${featureIndex}">Delete Feature</button>
                `;

                container.appendChild(newFeatureRow);
                featureIndex++;
            });

            // Add Technical
            document.getElementById('add-technical').addEventListener('click', function() {
                const container = document.getElementById('technical-container');
                const newTechnicalRow = document.createElement('div');
                newTechnicalRow.classList.add('technical-row', 'form-group');
                newTechnicalRow.setAttribute('data-index', technicalIndex);

                newTechnicalRow.innerHTML = `
                    <label for="technical_title_${technicalIndex}">Title:</label>
                    <input type="text" id="technical_title_${technicalIndex}" name="technical[${technicalIndex}][title]" class="form-control mb-2" required>
                    <label for="technical_desc_${technicalIndex}">Description:</label>
                    <textarea id="technical_desc_${technicalIndex}" name="technical[${technicalIndex}][desc]" class="form-control" required></textarea>
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-technical" data-index="${technicalIndex}">Delete Technical</button>
                `;

                container.appendChild(newTechnicalRow);
                technicalIndex++;
            });

            // Add Challenge
            document.getElementById('add-challenge').addEventListener('click', function() {
                const container = document.getElementById('challenge-container');
                const newChallengeRow = document.createElement('div');
                newChallengeRow.classList.add('challenge-row', 'form-group');
                newChallengeRow.setAttribute('data-index', challengeIndex);

                newChallengeRow.innerHTML = `
                    <label for="challenge_title_${challengeIndex}">Title:</label>
                    <input type="text" id="challenge_title_${challengeIndex}" name="challenge[${challengeIndex}][title]" class="form-control mb-2" required>
                    <label for="challenge_desc_${challengeIndex}">Description:</label>
                    <textarea id="challenge_desc_${challengeIndex}" name="challenge[${challengeIndex}][desc]" class="form-control" required></textarea>
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-challenge" data-index="${challengeIndex}">Delete Challenge</button>
                `;

                container.appendChild(newChallengeRow);
                challengeIndex++;
            });

            // Add Screenshots
            document.getElementById('add-screenshots').addEventListener('click', function() {
                const container = document.getElementById('screenshots-container');
                const newScreenshotRow = document.createElement('div');
                newScreenshotRow.classList.add('screenshots-row', 'form-group');
                newScreenshotRow.setAttribute('data-index', screenshotIndex);

                newScreenshotRow.innerHTML = `
                    <label for="screenshots_title_${screenshotIndex}">Title:</label>
                    <input type="text" id="screenshots_title_${screenshotIndex}" name="screenshots[${screenshotIndex}][title]" class="form-control mb-2" required>
                    <label for="screenshots_desc_${screenshotIndex}">Description:</label>
                    <textarea id="screenshots_desc_${screenshotIndex}" name="screenshots[${screenshotIndex}][desc]" class="form-control mb-2" required></textarea>
                    <label for="screenshots_${screenshotIndex}_image">Images:</label>
                    <input type="file" id="screenshots_${screenshotIndex}_image" name="screenshots[${screenshotIndex}][images][]" class="form-control mb-2 screenshot-upload" accept="image/*" multiple>
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-screenshot" data-index="${screenshotIndex}">Delete Screenshot</button>
                `;

                container.appendChild(newScreenshotRow);
                screenshotIndex++;
            });

            // Add Referce Link
            document.getElementById('add-reference').addEventListener('click', function() {
                const container = document.getElementById('reference-container');
                const newReferenceRow = document.createElement('div');
                newReferenceRow.classList.add('reference-row', 'form-group');
                newReferenceRow.setAttribute('data-index', referenceIndex);

                newReferenceRow.innerHTML = `
                <label for="reference_text_${referenceIndex}">Text:</label>
                <input type="text" id="reference_text_${referenceIndex}" name="reference[${referenceIndex}][text]" class="form-control mb-2">
                <label for="reference_link_${referenceIndex}">Link:</label>
                <input type="text" id="reference_link_${referenceIndex}" name="reference[${referenceIndex}][link]" class="form-control mb-2">
                <button type="button" class="btn btn-danger btn-sm mt-2 delete-reference" data-index="${referenceIndex}">Delete Referce Link</button>
            `;

                container.appendChild(newReferenceRow);
                referenceIndex++;
            });

            // Delete 
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-feature')) {
                    let index = event.target.getAttribute('data-index');
                    let screenshotRow = document.querySelector(`.feature-row[data-index="${index}"]`);
                    if (screenshotRow) {
                        screenshotRow.remove();
                    }
                } else if (event.target.classList.contains('delete-technical')) {
                    let index = event.target.getAttribute('data-index');
                    let screenshotRow = document.querySelector(`.technical-row[data-index="${index}"]`);
                    if (screenshotRow) {
                        screenshotRow.remove();
                    }
                } else if (event.target.classList.contains('delete-challenge')) {
                    let index = event.target.getAttribute('data-index');
                    let screenshotRow = document.querySelector(`.challenge-row[data-index="${index}"]`);
                    if (screenshotRow) {
                        screenshotRow.remove();
                    }
                } else if (event.target.classList.contains('delete-reference')) {
                    let index = event.target.getAttribute('data-index');
                    let screenshotRow = document.querySelector(`.reference-row[data-index="${index}"]`);
                    if (screenshotRow) {
                        screenshotRow.remove();
                    }
                } else if (event.target.classList.contains('delete-screenshot')) {
                    let index = event.target.getAttribute('data-index');
                    let screenshotRow = document.querySelector(`.screenshots-row[data-index="${index}"]`);
                    if (screenshotRow) {
                        screenshotRow.remove();
                    }
                }
            });

            // screenshot restrict
            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('screenshot-upload')) {
                    // Check if number of files selected exceeds 3
                    if (event.target.files && event.target.files.length > 3) {
                        alert('You can only upload up to 3 images.');
                        event.target.value = ''; // Reset the input
                    }
                }
            });
        });
    </script>
@endsection
