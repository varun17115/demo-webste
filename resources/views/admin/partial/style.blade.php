<style>
    .fixed-nav {
        left: 224px !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    hr {
        background-color: black
    }

    a {
        text-decoration: none;
        color: black
    }

    /* tr{height:50px} */
    .loading {
        z-index: 20;
        position: absolute;
        top: 0;
        left: -5px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .prev,
    .next {
        width: 50px;
        font-size: 20px;
        height: 30px
    }

    .loading-content {
        position: absolute;
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        top: 50%;
        left: 50%;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .main-div {
        height: 150px;
        width: 120px;
        margin: 2px;
        border: 1px solid grey;
        /* background-color:#80808038; */
    }

    #user_image {
        max-height: 100%;
        max-width: 100%;
    }

    .delete_btn {
        height: 16px;
        width: 16px;
        font-size: 12px
    }

    .title,
    .description {
        font-size: 12px
            /* white-space: nowrap; */
    }

    .mySlides {
        display: none;
        height: 350px;

    }

    img {
        vertical-align: middle;
    }

    .slideshow-container {
        max-width: 1000px;
    }


    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: .9
        }
    }


    .slide_image {
        max-height: 90%;
        max-width: 100%;

    }

    .prev_slide {
        left: 20px;
    }

    .next_slide {
        right: 20px;

    }

    .image_div {
        text-align: -webkit-center;
        height: 100px;
        width: 117px
    }

    #display_images {}

    #product_image {
        height: 300px;
        width: 300px;
    }

    .width {
        width: auto;
    }


    
    a:hover {
        cursor: pointer;
    }

    #products_table_next,
    #category_table_next,
    #brands_table_next,
    #table_next,
    #feedbacks_next,
    #orders_next {
        display: inline
    }

    .datatable_css .dataTables_length select {
        width: 100px;
        display: inline-block;
        margin-bottom: 10px;
    }

    .datatable_css .delete,
    .datatable_css .edit {
        font-size: 16px
    }

    .hover:hover {
        background-color: #13151b
    }

    .datatable_css .dataTables_filter input {
        margin-bottom: 10px;

    }

    @media only screen and (max-width:420px) {
        .fixed-nav {
            left: 0 !important;
        }
    }

    #feedbacks tbody {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap
    }

    ::-webkit-scrollbar {
        width: 4px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.5);
    }

    .text-black {
        color: black !important
    }
</style>
