import { Sidebar } from './components/Sidebar';
import { Header } from './components/Header';
import { Dashboard } from './components/Dashboard';
import { Scanner } from './components/Scanner';
import { TrackingList } from './components/TrackingList';
import { NewShipment } from './components/NewShipment';
import { useState } from 'react';

export default function App() {
  const [currentView, setCurrentView] = useState<'dashboard' | 'scanner' | 'tracking' | 'new-shipment'>('dashboard');

  return (
    <div className="flex min-h-screen bg-gray-50">
      <Sidebar currentView={currentView} setCurrentView={setCurrentView} />
      
      <div className="flex-1 flex flex-col">
        <Header />
        
        <main className="flex-1 p-8">
          {currentView === 'dashboard' && <Dashboard setCurrentView={setCurrentView} />}
          {currentView === 'scanner' && <Scanner />}
          {currentView === 'tracking' && <TrackingList />}
          {currentView === 'new-shipment' && <NewShipment />}
        </main>
      </div>
    </div>
  );
}
