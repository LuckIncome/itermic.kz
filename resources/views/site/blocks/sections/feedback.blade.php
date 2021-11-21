<section class="section feedback mb-8">
    <div class="feedback__inner container">
        <form class="feedback__form row" id="feedback-form">
            <div class="feedback__form-field mb-lg-0 col-lg-4">
                <input
                    class="feedback__form-input"
                    type="text"
                    placeholder="Ваше имя"
                    name="name"
                    required
                >
                <div class="feedback__form-error"></div>
            </div>

            <div class="feedback__form-field mb-lg-0 col-lg-4">
                <input
                    class="feedback__form-input js-input-phone"
                    type="text"
                    placeholder="Ваш телефон"
                    name="phone"
                    required
                >
                <div class="feedback__form-error"></div>
            </div>

            <div class="feedback__form-field mb-0 col-lg-4">
                <button class="feedback__form-submit btn btn--primary w-100" type="submit">
                    <span class="btn__label">Получить консультацию</span>
                    <span class="btn__loader"><i class="btn__loader-in"></i></span>
                </button>
            </div>
        </form>
    </div>
</section>
