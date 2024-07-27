@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Edit Project</h1>

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

            <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control"
                        value="{{ old('title', $project->title) }}" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" class="form-control"
                        value="{{ old('slug', $project->slug) }}" required>
                </div>

                <div class="form-group">
                    <label for="mainImage">Main Image:</label>
                    <input type="file" id="mainImage" name="mainImage" class="form-control mb-2" accept="image/*">
                </div>
                <img src="{{ asset('public/' . $project->mainImage) }}" alt="Screenshot" class="img-fluid mb-2"
                    style="max-width: 100px;">

                <div class="form-group">
                    <label for="shortDesc">Short Description:</label>
                    <textarea id="shortDesc" name="shortDesc" class="form-control" required>{{ old('shortDesc', $project->shortDesc) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea id="desc" name="desc" class="form-control" required>{{ old('desc', $project->desc) }}</textarea>
                </div>

                <!-- Overview section -->
                <h4>Overview</h4>
                <div class="form-group">
                    <label for="overview_name">Name:</label>
                    <input type="text" id="overview_name" name="overview[name]" class="form-control"
                        value="{{ old('overview.name', $project->overview['name']) }}" required>
                </div>

                <div class="form-group">
                    <label for="overview_duration">Duration:</label>
                    <input type="text" id="overview_duration" name="overview[duration]" class="form-control"
                        value="{{ old('overview.duration', $project->overview['duration']) }}" required>
                </div>

                <div class="form-group">
                    <label for="overview_tech">Tech:</label>
                    <input type="text" id="overview_tech" name="overview[tech]" class="form-control"
                        value="{{ old('overview.tech', $project->overview['tech']) }}" required>
                </div>

                <div class="form-group">
                    <label for="overview_role">Role:</label>
                    <input type="text" id="overview_role" name="overview[role]" class="form-control"
                        value="{{ old('overview.role', $project->overview['role']) }}" required>
                </div>

                <!-- Features section -->
                <h4>Features</h4>
                <div id="features-container">
                    @foreach ($project->features as $index => $feature)
                        <div class="feature-row form-group" data-index={{ $index }}>
                            <label for="features_title_{{ $index }}">Title:</label>
                            <input type="text" id="features_title_{{ $index }}"
                                name="features[{{ $index }}][title]" class="form-control mb-2"
                                value="{{ old('features.' . $index . '.title', $feature['title']) }}" required>
                            <label for="features_desc_{{ $index }}">Description:</label>
                            <textarea id="features_desc_{{ $index }}" name="features[{{ $index }}][desc]" class="form-control"
                                required>{{ old('features.' . $index . '.desc', $feature['desc']) }}</textarea>
                            @if ($index > 0)
                                <button type="button" class="btn btn-danger btn-sm mt-2 delete-feature"
                                    data-index={{ $index }}>Delete Feature</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-feature" class="btn btn-secondary mb-2">Add Feature</button>

                <!-- Technical section -->
                <h4>Technical</h4>
                <div id="technical-container">
                    @foreach ($project->technical as $index => $tech)
                        <div class="technical-row form-group" data-index={{ $index }}>
                            <label for="technical_title_{{ $index }}">Title:</label>
                            <input type="text" id="technical_title_{{ $index }}"
                                name="technical[{{ $index }}][title]" class="form-control mb-2"
                                value="{{ old('technical.' . $index . '.title', $tech['title']) }}" required>
                            <label for="technical_desc_{{ $index }}">Description:</label>
                            <textarea id="technical_desc_{{ $index }}" name="technical[{{ $index }}][desc]" class="form-control"
                                required>{{ old('technical.' . $index . '.desc', $tech['desc']) }}</textarea>
                            @if ($index > 0)
                                <button type="button" class="btn btn-danger btn-sm mt-2 delete-technical"
                                    data-index={{ $index }}>Delete Technical</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-technical" class="btn btn-secondary mb-2">Add Technical</button>

                <!-- Challenge section -->
                <h4>Challenge</h4>
                <div id="challenge-container">
                    @foreach ($project->challenge as $index => $item)
                        <div class="challenge-row form-group" data-index={{ $index }}>
                            <label for="challenge_title_{{ $index }}">Title:</label>
                            <input type="text" id="challenge_title_{{ $index }}"
                                name="challenge[{{ $index }}][title]" class="form-control mb-2"
                                value="{{ old('challenge.' . $index . '.title', $item['title']) }}" required>
                            <label for="challenge_desc_{{ $index }}">Description:</label>
                            <textarea id="challenge_desc_{{ $index }}" name="challenge[{{ $index }}][desc]" class="form-control"
                                required>{{ old('challenge.' . $index . '.desc', $item['desc']) }}</textarea>
                            @if ($index > 0)
                                <button type="button" class="btn btn-danger btn-sm mt-2 delete-challenge"
                                    data-index={{ $index }}>Delete Challenge</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-challenge" class="btn btn-secondary mb-2">Add Challenge</button>

                <!-- ScreenShots section -->
                <h4>ScreenShots</h4>
                <div id="screenshots-container">
                    <input type="hidden" name="deleted_screen_shot" class="deleted_screen_shot" value="">
                    @foreach ($project->screenshots as $index => $screenshot)
                        <div class="screenshots-row form-group" data-index={{ $index }}>
                            <input type="hidden" name="screenshots[{{ $index }}][id]"
                                value="{{ $screenshot['id'] }}" id="screenshots_id_{{ $index }}">
                            <label for="screenshots_title_{{ $index }}">Title:</label>
                            <input type="text" id="screenshots_title_{{ $index }}"
                                name="screenshots[{{ $index }}][title]" class="form-control mb-2"
                                value="{{ old('screenshots.' . $index . '.title', $screenshot['title']) }}" required>
                            <label for="screenshots_desc_{{ $index }}">Description:</label>
                            <textarea id="screenshots_desc_{{ $index }}" name="screenshots[{{ $index }}][desc]"
                                class="form-control mb-2" required>{{ old('screenshots.' . $index . '.desc', $screenshot['desc']) }}</textarea>
                            <label for="screenshots_images_{{ $index }}">Images:</label>
                            <input type="file" id="screenshots_images_{{ $index }}_1"
                                name="screenshots[{{ $index }}][images][]" class="form-control mb-2"
                                accept="image/*">
                            @if ($screenshot['path'])
                                @foreach (json_decode($screenshot['path']) as $image)
                                    <img src="{{ asset('public/' . $image) }}" alt="Screenshot" class="img-fluid mb-2"
                                        style="max-width: 100px;">
                                @endforeach
                            @endif
                            @if ($index > 0)
                                <button type="button" class="btn btn-danger btn-sm mt-2 delete-screenshot"
                                    data-index={{ $index }}>Delete Screenshot</button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-screenshots" class="btn btn-secondary mb-2">Add Screenshots Row</button>

                <!-- Add other fields similarly -->

                <div class="form-group">
                    <label for="outcome">Outcome:</label>
                    <textarea id="outcome" name="outcome" class="form-control" required>{{ old('outcome', $project->outcome) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="conclusion">Conclusion:</label>
                    <textarea id="conclusion" name="conclusion" class="form-control" required>{{ old('conclusion', $project->conclusion) }}</textarea>
                </div>

                <!-- Reference Link section -->
                <h4>Reference Link</h4>
                <div id="reference-container">
                    @if ($project->reference)
                        @foreach ($project->reference as $index => $item)
                            <div class="reference-row form-group" data-index={{ $index }}>
                                <label for="reference_text_{{ $index }}">Text:</label>
                                <input type="text" id="reference_text_{{ $index }}"
                                    name="reference[{{ $index }}][text]" class="form-control mb-2"
                                    value="{{ old('reference.' . $index . '.text', $item['text']) }}">
                                <label for="reference_link_{{ $index }}">Link:</label>
                                <input type="text" id="reference_link_{{ $index }}"
                                    name="reference[{{ $index }}][link]" class="form-control mb-2"
                                    value="{{ old('reference.' . $index . '.link', $item['link']) }}">
                                @if ($index > 0)
                                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-reference"
                                        data-index={{ $index }}>Delete Reference Link</button>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="reference-row form-group">
                            <label for="reference_text_0">Text:</label>
                            <input type="text" id="reference_text_0" name="reference[0][text]"
                                class="form-control mb-2" value="{{ old('reference.0.text') }}">
                            <label for="reference_link_0">Link:</label>
                            <input type="text" id="reference_link_0" name="reference[0][link]"
                                class="form-control mb-2" value="{{ old('reference.0.link') }}">
                        </div>
                    @endif
                </div>
                <button type="button" id="add-reference" class="btn btn-secondary mb-2">Add reference</button>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to handle dynamic rows -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let featureIndex = {{ count($project->features) }};
            let technicalIndex = {{ count($project->technical) }};
            let challengeIndex = {{ count($project->challenge) }};
            let screenshotIndex = {{ count($project->screenshots) }};
            let referenceIndex = {{ $project->reference ? count($project->reference) : 0 }};

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
                    <input type="hidden" name="screenshots[${screenshotIndex}][id]"
                    value="0" id="screenshots_id_${screenshotIndex}">
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

            // Add Reference Link
            document.getElementById('add-reference').addEventListener('click', function() {
                const container = document.getElementById('reference-container');
                const newReferenceRow = document.createElement('div');
                newReferenceRow.classList.add('reference-row', 'form-group');
                newReferenceRow.setAttribute('data-index', referenceIndex);

                newReferenceRow.innerHTML = `
                    <label for="reference_text_${referenceIndex}">Text:</label>
                    <input type="text" id="reference_text_${referenceIndex}" name="reference[${referenceIndex}][text]" class="form-control mb-2">
                    <label for="reference_link_${referenceIndex}">Link:</label>
                    <input type="text" id="reference_link_${referenceIndex}" name="reference[${referenceIndex}][link]" class="form-control mb-2" required>
                    <button type="button" class="btn btn-danger btn-sm mt-2 delete-reference" data-index="${referenceIndex}">Delete Reference Link</button>
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
                } else if (event.target.classList.contains('delete-screenshot')) {
                    let index = event.target.getAttribute('data-index');
                    let screenshotRow = document.querySelector(`.screenshots-row[data-index="${index}"]`);
                    let del = document.querySelector(`.deleted_screen_shot`)
                    if (del.value.length === 0) {
                        del.value = document.querySelector(
                            `#screenshots_id_${index}`).value
                    } else {

                        del.value = del.value + "," + document.querySelector(
                            `#screenshots_id_${index}`).value
                    }
                    // deleted_screen_shot
                    // screenshots_id_
                    if (screenshotRow) {
                        screenshotRow.remove();
                    }
                }
            });
        });
    </script>
@endsection
