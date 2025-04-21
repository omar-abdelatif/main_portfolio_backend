$(function () {
    //! 
    if ($("#table")) {
        $("#table").DataTable({
            paging: true,
            scrollY: 400,
            ordering: true,
            autoWidth: true,
            searching: true,
            pageLength: 20,
            pagingTag: "button",
            pagingType: "simple_numbers",
        });
    }
    //! Azkar Fetch Api
    const azkarContainer = $(".notification-slider");
    azkarContainer.empty();
    $.ajax({
        url: "https://raw.githubusercontent.com/nawafalqari/ayah/refs/heads/main/src/data/adkar.json",
        method: "GET",
        dataType: "json",
        success: function (data) {
            const tsabeh = data.تسابيح;

            // تأكد لو في slick متشغل يتقفل
            if (azkarContainer.hasClass("slick-initialized")) {
                azkarContainer.slick("unslick");
            }

            tsabeh.forEach((item) => {
                const azkarItem = `
                <div class="d-flex h-100">
                    <h6 class="mb-0 fw-400">
                        <span class="text-primary">${item.content}</span> -
                        <span class="text-secondary">(${item.count}) مره</span> 
                    </h6>
                </div>`;
                azkarContainer.append(azkarItem);
            });

            // استنى شوية بعد إضافة العناصر قبل ما تشغل slick
            setTimeout(() => {
                azkarContainer.slick({
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    arrows: false,
                    dots: false,
                    vertical: true,
                    verticalSwiping: true,
                });
            }, 100); // ممكن تزود لـ 200 أو 300 لو شفت إنه لسه بيلخبط
        },
        error: function (xhr, status, error) {
            console.error("Error fetching data:", error);
            azkarContainer.append(`
                <div class="d-flex h-100">
                    <h6 class="mb-0 fw-400 text-danger">
                        Failed to load content. Please try again later.
                    </h6>
                </div>
            `);
        },
    });
})

const tagInput = document.querySelector("#tags");
if (tagInput) {
    new Tagify(tagInput);
}

const tagInputUpdateMethod = document.querySelectorAll("input[data-project-id]").forEach(function(input) {
    const tag = new Tagify(input);
    const form = input.closest("form");
    form.addEventListener("submit", function () {
        const tagValues = tag.value.map(tag => tag.value);
        input.value = tagValues.join(",");
    });
});

function createFeature() {
    const featureDiv = document.createElement('div');
    featureDiv.classList.add('feature-item');
    featureDiv.innerHTML = `
        <hr class="my-4"/>
        <div class="d-flex justify-content-between">
            <input type="text" name="name[]" placeholder="Feature name" class="flex-1 text-white form-control" />
            <button type="button" class="btn btn-danger px-2 py-2 ms-2 remove-feature">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    `;
    return featureDiv;
}

function updateFeatureIndices() {
    document.querySelectorAll('#features-container .feature-item').forEach((div) => {
        const input = div.querySelector('input');
        input.name = `name[]`;
        input.className = `flex-1 text-white form-control`;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const addFeatureButton = document.querySelector('.add-feature');
    const featuresContainer = document.getElementById('features-container');

    if (addFeatureButton && featuresContainer) {
        addFeatureButton.addEventListener('click', function () {
            const index = featuresContainer.children.length;
            const featureDiv = createFeature(index);
            featuresContainer.appendChild(featureDiv);
        });

        featuresContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-feature') || e.target.closest('.remove-feature')) {
                e.target.closest('.feature-item').remove();
                updateFeatureIndices();
            }
        });
    }
});
