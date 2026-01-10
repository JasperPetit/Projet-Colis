import { useState } from "react";
import { Sidebar } from "./components/Sidebar";
import { TopBar } from "./components/TopBar";
import { Dashboard } from "./components/pages/Dashboard";
import { Commandes } from "./components/pages/Commandes";
import { Colis } from "./components/pages/Colis";
import { Fournisseurs } from "./components/pages/Fournisseurs";
import { Administration } from "./components/pages/Administration";
import { Tutoriel } from "./components/pages/Tutoriel";

export default function App() {
  const [currentPage, setCurrentPage] = useState("accueil");

  const renderPage = () => {
    switch (currentPage) {
      case "accueil":
        return <Dashboard />;
      case "commandes":
        return <Commandes />;
      case "colis":
        return <Colis />;
      case "fournisseurs":
        return <Fournisseurs />;
      case "administration":
        return <Administration />;
      case "tutoriel":
        return <Tutoriel />;
      default:
        return <Dashboard />;
    }
  };

  return (
    <div className="flex min-h-screen bg-background">
      <Sidebar currentPage={currentPage} onNavigate={setCurrentPage} />
      <div className="flex-1 flex flex-col">
        <TopBar />
        <main className="flex-1">
          {renderPage()}
        </main>
      </div>
    </div>
  );
}
