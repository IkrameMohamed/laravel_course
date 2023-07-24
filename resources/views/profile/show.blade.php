<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- component -->
            <div class="md:px-32 py-8 w-full">
                <div class="shadow overflow-hidden rounded border-b border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">tite</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">description</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">

                       @foreach(auth()->user()->posts()->withTrashed()->get() as $post)
                           <tr>
                               <td class="w-1/3 text-left py-3 px-4">{{$post->title}}</td>
                               <td class="w-1/3 text-left py-3 px-4">{{Str::limit($post->body,50)}}</td>
                               <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">

                                       <a href="{{route('posts.edit', $post->slug)}}" class="bg-inherit  text-blue-700 font-bold py-2 px-4 rounded-full">
                                           Modifier
                                       </a>
                                      @if($post->trashed())
                                           <a href="{{route('posts.restore', $post->slug)}}" class="bg-yellow-500 hover:bg-yellow-700 text-green-600 font-bold py-2 px-4 rounded-full">
                                               Recuperé
                                           </a>

                                           <form id ="{{$post->id}}" action="{{route('posts.delete' , $post->slug)}}" method="post">
                                               @csrf
                                               @method('DELETE')
                                           </form>
                                       @else
                                           <form id ="{{$post->id}}" action="{{route('posts.destroy' , $post->slug)}}" method="post">
                                               @csrf
                                               @method('DELETE')
                                           </form>
                                       @endif
                                       <button onclick="event.preventDefault();
                        if(confirm('vous etes sur?'))
                        document.getElementById({{$post->id}}).submit();"
                                               class="bg-blue-500 hover:bg-red-700 text-red-600 font-bold py-2 px-4 rounded-full" type="submit">
                                           @if($post->trashed())
                                               supprimer definitivment
                                           @else
                                           suprimmer
                                           @endif
                                       </button>

                                   </a></td>

                           </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
