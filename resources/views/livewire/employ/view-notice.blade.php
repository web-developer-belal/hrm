<div class="">
    <div class="max-w-6xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg shadow hover:bg-gray-700 transition">
                ← Back
            </a>
        </div>

        {{-- Notice Card --}}
        <div class="bg-white rounded-2xl shadow-lg p-6">

            {{-- Header --}}
            <div class="border-b pb-4 mb-4">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $notice->title }}
                </h1>

                <div class="mt-2 flex flex-wrap gap-4 text-sm text-gray-500">
                    <span>
                        <strong>Branch:</strong>
                        {{ $notice->branch->name ?? 'N/A' }}
                    </span>

                    <span>
                        <strong>Department:</strong>
                        {{ $notice->department->name ?? 'N/A' }}
                    </span>

                    <span>
                        <strong>Status:</strong>
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $notice->status === 'active' 
                                ? 'bg-green-100 text-green-700' 
                                : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($notice->status) }}
                        </span>
                    </span>
                </div>
            </div>

            {{-- Description --}}
            <div class="prose max-w-none text-gray-700 mb-6">
                {!! nl2br(e($notice->description)) !!}
            </div>

            {{-- Attachments --}}
            @if($notice->attachments && count($notice->attachments))
                <div>
                    <h2 class="text-lg font-semibold mb-3 text-gray-800">
                        Attachments
                    </h2>

                    <div class="space-y-6">
                        @foreach($notice->attachments as $file)

                            @php
                                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                $fileUrl = asset(Storage::url($file));
                                $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                                $docExtensions = ['pdf','doc','docx'];
                            @endphp

                            {{-- Image Preview --}}
                            @if(in_array($extension, $imageExtensions))
                                <div class="border rounded-lg overflow-hidden shadow">
                                    <img src="{{ $fileUrl }}"
                                         class="w-full max-h-96 object-contain bg-gray-50"
                                         alt="Attachment Image">
                                </div>

                            {{-- Document / PDF Preview --}}
                            @elseif(in_array($extension, $docExtensions))
                                <div class="border rounded-lg overflow-hidden shadow">
                                    <iframe src="{{ $fileUrl }}"
                                            class="w-full h-96"
                                            frameborder="0">
                                    </iframe>
                                </div>

                            {{-- Fallback Download --}}
                            @else
                                <div class="p-4 bg-gray-50 border rounded-lg">
                                    <a href="{{ $fileUrl }}"
                                       target="_blank"
                                       class="text-blue-600 underline">
                                        Download Attachment
                                    </a>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
