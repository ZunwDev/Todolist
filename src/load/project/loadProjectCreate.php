<section id="popupOverlay" class="w-screen z-50 h-screen absolute bg-slate-50/25">
    <div id="popupElement" class="absolute flex left-0 right-0 ml-auto mr-auto top-28 border border-slate-300 flex-col h-fit w-80 shadow-lg bg-slate-50 rounded-lg beforeShowUp">
        <div class="deleteHeader flex flex-row w-full h-8 border-b border-slate-200 gap-4">
            <div class="my-1 ml-4 w-full h-full font-bold">New project</div>
            <div class="ml-auto mt-1 mr-1 flex h-fit w-fit px-1 py-1 rounded-lg hover:bg-slate-200 cursor-pointer" onclick="closeAnyPopup()"><svg class="h-4 w-4" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                </svg></div>
        </div>
        <form class="flex flex-col w-full h-full bg-slate-50 rounded-b-lg" method="post">
            <div class="mt-4 px-6 flex flex-col gap-1">
                <label class="font-bold">Name</label>
                <input autocomplete="none" id="nameInputCreate" placeholder="e.g Work, Bussiness" type="text" class="flex shadow-md form-control block w-full px-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none" autocomplete="none">
            </div>
            <div class="mt-4 px-6 flex flex-col gap-1">
                <label class="font-bold">Description</label>
                <textarea autocomplete="none" id="projectDescriptionCreate" placeholder="Describe this project" maxlength="128" class="descriptionInput flex overflow-y-auto shadow-md h-20 form-control block w-full px-2 text-base font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out duration-200 m-0 focus:text-slate-700 focus:bg-slate-50 focus:border-slate-600 focus:outline-none resize-none" autocomplete="none"></textarea>
            </div>
            <div class="mt-4 px-6 flex flex-col gap-1">
                <label for="colorChoose" class="font-bold">Color</label>
                <div id="colorChoose" class="colorSelectMenu flex flex-col h-[1.7rem] border border-slate-200 bg-slate-50">
                    <div class="flex flex-row w-full h-[1.7rem] cursor-pointer">
                        <div id="currentColor" class="flex w-4 h-4 mt-[0.3rem] ml-2 rounded-md bg-red-800"></div>
                        <div id="1" class="currentColorName flex h-4 mt-[0.1rem] pl-3">Dark Red</div>
                        <div class="flex h-4 w-4 ml-auto my-auto mt-1 mr-2">
                            <svg id="angleColor" class="flex h-4 w-4 fill-black toggle-up" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 256 512">
                                <path d="M64 448c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L178.8 256L41.38 118.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25l-160 160C80.38 444.9 72.19 448 64 448z" />
                            </svg>
                        </div>
                    </div>
                    <div id="colorSelect" class="flex flex-wrap mx-auto py-3 pl-[1.15rem] gap-2 relative w-fit h-0 opacity-0 duration-100 bg-slate-100 rounded-lg mt-4 transition-[height]" style="display: none">
                    </div>
                </div>
            </div>
            <div class="flex flex-row gap-2 justify-end mr-2">
                <button title="Add - Enter" type="button" class="projectCreateAccept mt-4 py-1 px-3 mb-3 bg-slate-500 text-white rounded-lg border border-slate-400 hover:bg-slate-600">
                    Add
                </button>
            </div>
        </form>
    </div>
</section>