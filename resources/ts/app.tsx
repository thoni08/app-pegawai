import "../css/app.css"
import { createInertiaApp } from "@inertiajs/react"
import { createRoot } from "react-dom/client"

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob("./pages/**/*.tsx", { eager: true })
    let page: any = pages[`./pages/${name}.tsx`]
    // page.default.layout = page.default.layout || ((page: any) => <>{page}</>);
    if (!page) {
      throw new Error(`Page not found: ${name}`);
    }
    return page
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})