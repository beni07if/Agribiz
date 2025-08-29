<style>
    .search-wrapper {
        transition: all 0.4s ease;
        max-width: 50%;
    }

    .search-input:focus {
        outline: none;
        box-shadow: none;
    }

    /* Saat hover wrapper → expand + show input */
    .search-wrapper:hover .search-input,
    .search-wrapper:focus-within .search-input {
        display: block !important;
        width: 100%;
    }

    .search-wrapper:hover {
        padding-right: 8px;
        background: #f8f9fc;
    }

    .search-btn {
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
</style>