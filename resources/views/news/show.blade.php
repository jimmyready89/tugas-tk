@extends('layouts.app')

@section('title', $news->title . ' - Portal Berita Perusahaan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Kembali ke Daftar Berita
        </a>
    </div>

    <article class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-8 border-b border-gray-200">
            <div class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                {{ $news->news_tag }}
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>
            
            <div class="flex flex-wrap items-center text-sm text-gray-500 gap-4">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Penulis: {{ $news->author_nip }}</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $news->created_at->format('d F Y, H:i') }}</span>
                </div>
                
                @if($news->updated_at != $news->created_at)
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Diperbarui: {{ $news->updated_at->format('d F Y, H:i') }}</span>
                    </div>
                @endif
            </div>

            @auth
                @if(auth()->user()->nip === $news->author_nip || auth()->user()->role === 'admin')
                    <div class="flex space-x-3 mt-4">
                        <a href="{{ route('news.edit', $news->news_id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-sm">
                            Edit Berita
                        </a>
                        <button onclick="deleteNews('{{ $news->news_id }}')" 
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-sm">
                            Hapus Berita
                        </button>
                    </div>
                @endif
            @endauth
        </div>

        <div class="px-6 py-8">
            <div class="prose prose-lg max-w-none">
                {!! nl2br(e($news->body)) !!}
            </div>
        </div>
    </article>

    <div class="mt-8 bg-white rounded-lg shadow-lg">
        <div class="px-6 py-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900">
                Komentar ({{ $comments->count() }})
            </h2>
        </div>

        @auth
            <div class="px-6 py-6 border-b border-gray-200 bg-gray-50">
                <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="news_id" value="{{ $news->news_id }}">
                    
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                            Tulis Komentar
                        </label>
                        <textarea name="comment" id="comment" rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Tulis komentar Anda di sini..."></textarea>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg">
                            Kirim Komentar
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="px-6 py-6 border-b border-gray-200 bg-gray-50 text-center">
                <p class="text-gray-600">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">Login</a> 
                    untuk menambahkan komentar
                </p>
            </div>
        @endauth

        <div class="divide-y divide-gray-200">
            @forelse($comments as $comment)
                @if($comment->is_visible)
                    <div class="px-6 py-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <p class="text-sm font-medium text-gray-900">{{ $comment->comment_by }}</p>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</p>
                                        @if($comment->updated_at != $comment->created_at)
                                            <span class="text-xs text-gray-400">(diedit)</span>
                                        @endif
                                    </div>
                                    
                                    @auth
                                        @if(auth()->user()->nip === $comment->comment_by || auth()->user()->role === 'admin')
                                            <div class="flex space-x-2">
                                                <button onclick="editComment('{{ $comment->comment_id }}')" 
                                                        class="text-gray-400 hover:text-yellow-500 text-sm">
                                                    Edit
                                                </button>
                                                <button onclick="hideComment('{{ $comment->comment_id }}')" 
                                                        class="text-gray-400 hover:text-red-500 text-sm">
                                                    Hapus
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                
                                <div class="mt-2">
                                    <p class="text-gray-700">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-gray-500">Belum ada komentar untuk berita ini.</p>
                    @auth
                        <p class="text-gray-400 text-sm mt-2">Jadilah yang pertama memberikan komentar!</p>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const deleteNews = (newsId) => {
            if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/news/${newsId}`;
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                const tokenField = document.createElement('input');
                tokenField.type = 'hidden';
                tokenField.name = '_token';
                tokenField.value = document.querySelector('meta[name="csrf-token"]').content;
                
                form.appendChild(methodField);
                form.appendChild(tokenField);
                document.body.appendChild(form);
                form.submit();
            }
        }

        const hideComment = (commentId) => {
            if (confirm('Apakah Anda yakin ingin menghapus komentar ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/comments/${commentId}/hide`;
                
                const tokenField = document.createElement('input');
                tokenField.type = 'hidden';
                tokenField.name = '_token';
                tokenField.value = document.querySelector('meta[name="csrf-token"]').content;
                
                form.appendChild(tokenField);
                document.body.appendChild(form);
                form.submit();
            }
        }

        const editComment = (commentId) => {
            const newComment = prompt('Edit komentar:');
            if (newComment && newComment.trim()) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/comments/${commentId}`;
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PUT';
                
                const tokenField = document.createElement('input');
                tokenField.type = 'hidden';
                tokenField.name = '_token';
                tokenField.value = document.querySelector('meta[name="csrf-token"]').content;
                
                const commentField = document.createElement('input');
                commentField.type = 'hidden';
                commentField.name = 'comment';
                commentField.value = newComment;
                
                form.appendChild(methodField);
                form.appendChild(tokenField);
                form.appendChild(commentField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endpush
@endsection
