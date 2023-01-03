@extends('smart-ads::layouts.app')
@section('content')
<div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Create New Ad
        </h2>

        <form action="/smart-ad-manager/ads/store" method="POST">
            @csrf
        <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Ad Name" name="name" value="{{old('name')}}"
                />
                @error('name')
                <span class="text-xs text-red-600 dark:text-red-400">
                  {{$message}}
                </span>
                @enderror
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Ad Body</span>
                <textarea
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="7"
                  placeholder="Enter html body of the form." name="body"
                >{{old('body')}}</textarea>
                @error('body')
                <span class="text-xs text-red-600 dark:text-red-400">
                  {{$message}}
                </span>
                @enderror
              </label>

              <h3 class="my-3">Automatic Ad Insertion (Optional)</h3>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Ad Position</span>
                <select name="position" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                  <option value="">None</option>
                  <option value="beforebegin">Before HTML Selector</option>
                  <option value="afterend">After HTML Selector</option>
                  <option value="afterbegin">Inside HTML Selector (At Beginning)</option>
                  <option value="beforeend">Inside HTML Selector (At End)</option>
                </select>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Selector</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="CSS Selector like #id-name / .class-name / body > p" name="selector" value="{{old('name')}}"
                />
              </label>

              <div class="my-3">
                <button type="submit" class="inline-flex items-center rounded-md  bg-purple-600 border border-transparent active:bg-purple-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">Add</button>
              </div>

            </div>
        </form>



</div>
@endsection