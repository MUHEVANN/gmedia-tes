@props(['productCategory'])

@foreach ($productCategory as $item)
    <li class="me-2">
        <a href="#" data-id="{{ $item->id }}"
            class="category_id inline-block p-4 border-b-2 transition-all duration-300 ease-in-out border-transparent rounded-t-lg  hover:text-blue-700 hover:border-blue-700 dark:hover:text-gray-300">{{ $item->name }}</a>
    </li>
@endforeach
